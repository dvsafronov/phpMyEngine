<?php

//@todo комментить! код!!!!
//@todo обязательно!!!
namespace phpMyEngine\Database\filesDataStorage;

include_once 'lib/filesDataStorage/filesDataStorage.php';

function filterToCommand ( $filter = false, $preparetosearch = false ) {
    if (is_null ( $filter )) return 'null';
    if ($filter === false) return 'false';
    if ($filter === true) return 'true';
    if (is_scalar ( $filter )) {
        if (is_float ( $filter )) {
            $filter = str_replace ( ",", ".", $filter );
        }
        $replcaes = array (array ("\\", "/", "\n", "\t", "\r", "\b", "\f", '"', "'"),
            array ('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"', "\'"));
        $val = str_replace ( $replcaes[0], $replcaes[1], $filter );
        return is_numeric ( $val ) ? $val : "'" . $val . "'";
    }
    $result = array ();
    foreach ($filter as $key => $value) {
        if (false === strpos ( $key, '\\' )) { // skip private fields of object
            if (is_numeric ( $key )) {
                $result[] = filterToCommand ( $value, $preparetosearch );
            } else {
                if ($value !== null) {
                    $result[] = filterToCommand ( $key, $preparetosearch ) . "=>" . filterToCommand ( $value, $preparetosearch );
                }
            }
        }
    }
    return 'array(' . implode ( ',', $result ) . ')';
}

function returnConnection () {
    $_myDBStorage = \phpMyEngine\Database\Storage::getInstance ();
    if ($_myDBStorage->_connection instanceof \filesDataStorage\filesDataStorage) {
        return $_myDBStorage->_connection;
    } else {
        createConnection();
        return returnConnection();
    }
}

function createConnection () {
    $_myDBStorage = \phpMyEngine\Database\Storage::getInstance ();
    $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( '', 'var/storage' );
    $_myDBStorage->_connection = new \filesDataStorage\filesDataStorage ( $rp );
    return true;
}

function doQuery ( $queryStr ) {
    $returnStr = "return \\" . __NAMESPACE__ . '\returnConnection()->' . $queryStr . ';';
    $resultFnc = create_function ( null, $returnStr );
    $resultDB = $resultFnc();
    if (is_bool ( $resultDB )) {
        return $resultDB;
    }
    if (is_array ( $resultDB )) {
        $ca = (int) count ( $resultDB );
        if ($ca > 0) {
            $result = array ();
            for ($i = 0; $i < $ca; $i++) {
                $result[$i] = array_map ( function ($str) {
                                    $replcaes = array (array ("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
                                        array ('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
                                    return str_replace ( $replcaes[1], $replcaes[0], $str );
                                }, (array) $resultDB[$i] );
                $result[$i]['_id'] = (double) $resultDB[$i]['_id'];
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
                $queryFilter = new \filesDataStorage\QueryFilter();
                if (isset ( $filter['limit'] ) && $filter['limit'] > 0) {
                    $queryFilter->setLimit ( (int) $filter['limit'] );
                }
                if (isset ( $filter['offset'] ) && $filter['offset'] > 0) {
                    $queryFilter->setOffset ( (int) $filter['offset'] );
                }
                if (isset ( $filter['orderBy'] )) {
                    $queryFilter->setOrderField ( $filter['orderBy'] );
                }
                if (isset ( $filter['order'] )) {
                    $queryFilter->setOrderDirection ( (int) $filter['order'] );
                }
                unset ( $filter['limit'], $filter['offset'], $filter['order'], $filter['orderBy'] );
                $queryFilter->setData ( $filter );
                $queryStr .= '->get("' . $queryFilter . '")';
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