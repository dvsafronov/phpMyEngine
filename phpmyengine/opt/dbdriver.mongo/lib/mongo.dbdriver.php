<?php

//@todo комментить! код!!!!
//@todo обязательно!!!
namespace phpMyEngine\Database\Mongo;

function filterToCommand ( $filter = false, $preparetosearch = false ) {
    if (is_null ( $filter )) return 'null';
    if ($filter === false) return 'false';
    if ($filter === true) return 'true';
    if (is_scalar ( $filter )) {
        if (is_float ( $filter )) {
            $filter = str_replace ( ",", ".", $filter );
        }
        $replcaes = array (array ("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
            array ('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
        $val = str_replace ( $replcaes[0], $replcaes[1], $filter );
        return is_numeric ( $val ) ? $val : "'" . $val . "'";
    }
    $result = array ();
    foreach ($filter as $key => $value) {
        // если на передали объект, то переделываем его в нужный для mongo вид
        if ($preparetosearch == true && \is_object ( $value )) {
            foreach ($value as $subkey => $subvalue) {
                $key = $key . '.' . $subkey;
                $value = $subvalue;
            }
        }
        if (false === strpos ( $key, '\\' )) { // skip private fields of object
            if (is_numeric ( $key )) {
                $result[] = filterToCommand ( $value, $preparetosearch );
            } else {
                if ($value !== null) {
                    if ($key === '$btw') {
                        $result[] = filterToCommand ( '$gte' ) . "=>" .
                                filterToCommand ( $value[0] ) . "," .
                                filterToCommand ( '$lte' ) . "=>" .
                                filterToCommand ( $value[1] );
                    } else {
                        $result[] = filterToCommand ( $key, $preparetosearch ) . "=>" . filterToCommand ( $value, $preparetosearch );
                    }
                }
            }
        }
    }
    return 'array(' . implode ( ',', $result ) . ')';
}

function returnConnection () {
    $_myDBStorage = \phpMyEngine\Database\Storage::getInstance ();
    if ($_myDBStorage->_connection instanceof \MongoDB) {
        return $_myDBStorage->_connection;
    } else {
        createConnection();
        return returnConnection();
    }
}

function createConnection () {
    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $curDBProfile = $_myConfig->engine->databaseProfile;
    if ($_myConfig->$curDBProfile === null) {
        \phpMyEngine\logError ( 'Database config not set ' );
        return false;
    } elseif (!is_object ( $_myConfig->$curDBProfile )) {
        \phpMyEngine\logError ( 'Database config is null ' );
        return false;
    } elseif (!isset ( $_myConfig->$curDBProfile->host ) || !isset ( $_myConfig->$curDBProfile->database )
            || !isset ( $_myConfig->$curDBProfile->user ) || !isset ( $_myConfig->$curDBProfile->password )) {
        \phpMyEngine\logError ( 'Database config is invalid ' );
        return false;
    }
    $dbConnection = new \Mongo ( $_myConfig->$curDBProfile->host, array ("persist" => $_myConfig->$curDBProfile->database) );
    if ($dbConnection->connected === true) {
        $dbDataBase = $dbConnection->selectDB ( $_myConfig->$curDBProfile->database );
        $dbDataBase->authenticate ( $_myConfig->$curDBProfile->user, $_myConfig->$curDBProfile->password );
        $lastError = $dbDataBase->lastError ();
        if ($lastError['err'] !== null) {
            \phpMyEngine\logError ( 'Database selecting error:' . $lastError['err'] );
            $dbConnection->close ();
            return false;
        } else {
            $_myDBStorage = \phpMyEngine\Database\Storage::getInstance ();
            $_myDBStorage->_connection = $dbDataBase;
            return true;
        }
    } else {
        \phpMyEngine\logError ( 'Database connection error' );
        return false;
    }
}

function doQuery ( $queryStr ) {
    $returnStr = "return \\" . __NAMESPACE__ . '\returnConnection()->' . $queryStr . ';';
    $cursorFnc = create_function ( null, $returnStr );
    $cursor = $cursorFnc();
    if (is_bool ( $cursor )) {
        return $cursor;
    }
    if ($cursor instanceof \MongoCursor) {
        $ca = (int) $cursor->count ();
        if ($ca > 0) {
            $result = array ();
            for ($i = 0; $i < $ca; $i++) {
                $result[$i] = array_map ( function ($str) {
                                    $replcaes = array (array ("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
                                        array ('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                                    return str_replace ( $replcaes[1], $replcaes[0], $str );
                                }, (array) $cursor->getNext () );
                $result[$i]['_id'] = (double) $cursor->key ();
            }
            return $result;
        }
        return array ();
    }
    return false;
}

function generateQuery ( array $filter, $collection, $type ) {
    if (isset ( $filter['fields'] )) {
        $onlyFields = $filter['fields'];
        unset ( $filter['fields'] );
    } else {
        $onlyFields = array ();
    }
    $queryStr = "selectCollection('{$collection}')";
    switch ($type) {
        case \phpMyEngine\Database\REQUEST_TYPE_QUERY: {
                $addStr = null;
                if (isset ( $filter['limit'] ) && $filter['limit'] > 0) {
                    $addStr .= "->limit(" . (int) $filter['limit'] . ")";
                }
                if (isset ( $filter['offset'] ) && $filter['offset'] > 0) {
                    $addStr .= "->skip(" . (int) $filter['offset'] . ")";
                }
                if (isset ( $filter['orderBy'] ) && isset ( $filter['order'] )) {
                    $addStr .= "->sort(array('{$filter['orderBy']}'=>{$filter['order']}))";
                }
                unset ( $filter['limit'], $filter['offset'], $filter['order'], $filter['orderBy'] );
                $queryStr .= "->find(" . filterToCommand ( $filter, true ) . "," . filterToCommand ( $onlyFields ) . ")" . $addStr;
                break;
            }
        case \phpMyEngine\Database\REQUEST_TYPE_SAVE: {
                unset ( $filter['limit'], $filter['offset'], $filter['order'], $filter['orderBy'] );
                $queryStr .= "->save(" . filterToCommand ( $filter ) . ");";
                break;
            }
        case \phpMyEngine\Database\REQUEST_TYPE_REMOVE: {
                $queryStr .= "->remove(" . filterToCommand ( $filter ) . ")";
                break;
            }
    }
    return $queryStr;
}