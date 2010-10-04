<?php

/**
 * Библиотека классов и функций phpMyEngine
 * для работы с записями (Records)
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace phpMyEngine\Records;

const PME_RECORDS_COLLECTION = 'records';

class Mutagen {
    private $_validateRules = null, $_properties;

    public function __set ( $name, $value ) {
        \phpMyEngine\Records\Validate\validateInputData ( $this, $name, $value );
        return null;
    }

    public function __construct ( $name = null, Array $data = null ) {
        if (true === \is_null ( $name )) {
            return null;
        }
        $this->loadModel ( $name, 'records', $data );
        return null;
    }

    final function loadModel ( $name, $cat, Array $data = null ) {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( \strtolower ( $name ) . '.json', 'etc/mutagens/' . $cat )) {
            $tmpJSON = json_decode ( \file_get_contents ( $rp ) );
            $validator = array ();
            foreach ($tmpJSON as $key => $value) {
                if ($key !== '_specialNotes') {
                    $this->$key = null;
                    $this->_properties[] = $key;
                    $validator[$key] = $value;
                } else {
                    $this->_specialNotes = (array) $value;
                }
            }
        } else {
            throw new \Exception ( 'Mutagen ' . $cat . '/' . $name . ' not found' );
        }
        $this->_validateRules = $validator;
        $key = $value = null;
        if ($data !== null && is_array ( $data )) {
            foreach ($data as $key => $value) {
                if (in_array ( $key, $this->_properties )) {
                    $this->$key = $value;
                }
            }
        }
        return null;
    }

    public function getProperties () {
        return (array) $this->_properties;
    }

    public function getValidateRules () {
        return (array) $this->_validateRules;
    }

    public function getValues () {
        $result = array ();
        foreach ($this->_properties as $key) {
            $result[$key] = $this->$key;
        }
        return $result;
    }

}

class Record {
    const STATUS_HIDDEN = 1;
    const STATUS_DELETED = 2;
    const STATUS_OK = 0;

// Свойства
    public $_id, $mutagenType = null, $status = self::STATUS_OK, $tags = '';
    public $ratingPositive = 0, $ratingNegative = 0;
    public $permissions = 0, $requests = 0;
    public $owner;
    public $mutagenData;

    public function __construct ( $array = null ) {
        $this->_id = (double) (hexdec ( \uniqid () ) / 100);
        $this->mutagenData = new Mutagen();
        if (isset ( $array ) && is_array ( $array )) {
            foreach ($array as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public function getCreationTime ( $format = 'd.m.Y H:i:s' ) {
        /*
         *
         * 10485.76 - это очень магическая цифра, менять её нельзя
         * Именно благодаря ей, волшебству и парням с улиц, идентификатор
         * записи превращяется во время, когда этот идентификатор был установлен
         * Магия, ёпт.
         *
         */
        return date ( $format, $this->_id / 10485.76 );
    }

    public function save () {
        $q = \phpMyEngine\Database\generateQuery ( (array) $this, PME_RECORDS_COLLECTION
                        , \phpMyEngine\Database\REQUEST_TYPE_SAVE );
        return \phpMyEngine\Database\doQuery ( $q );
    }

    public function delete () {
        
    }

    public function upRating () {


        return $this->save ();
    }

    public function downRating () {
        return $this->save ();
    }

    public function incrementRequests () {
        return $this->save ();
    }

    public function applyMutagen ( $name, Array $data = null ) {
        $this->mutagenType = $name;
        $this->mutagenData = new Mutagen ( \strtolower ( $name ) );
    }

}

class Filter {
    const ORDER_DESC = - 1;
    const ORDER_ASC = 1;
    const ORDER_RAND = 2;

    public $_id, $mutagenType, $status, $tags;
    public $ratingPositive, $ratingNegative;
    public $permissions, $requests;
    public $owner, $mutagenData;

    public function __construct ( $id = null ) {
        foreach ($this as $key => $value) {
            $this->$key = null;
            $this->mutagenData = new \stdClass();
        }
        if ($id !== null && is_double ( $id )) {
            $this->_id = (double) $id;
        }
    }

    public function getRecords () {
        $filter = (array) $this;
        if (count ( (array) $filter['mutagenData'] ) == 0) {
            unset ( $filter['mutagenData'] );
        }
        $queryStr = \phpMyEngine\Database\generateQuery ( $filter, PME_RECORDS_COLLECTION );
        $myResult = \phpMyEngine\Database\doQuery ( $queryStr );
        $ca = count ( $myResult );
        $myStorage = new Storage();
        if ($ca > 0) {
            $myStorage->allCount = $ca;
            for ($i = 0; $i < $ca; $i++) {
                if ($myResult [$i]['_id'] == 0) {
                    break;
                }
                $myStorage->records [$i] = new Record ( $myResult [$i] );
                unset ( $myResult [$i] );
                try {
                    $myStorage->records[$i]->mutagenData =
                            new Mutagen ( $myStorage->records[$i]->mutagenType,
                                    (array) $myStorage->records[$i]->mutagenData );
                } catch (\phpMyEngine\Exception $myException) {
                    \phpMyEngine\logError ( $myException->text );
                }
            }
            $myStorage->count = $i;
        }
        return $myStorage;
    }

}

class FilterOperation {
//Operation Greater Then (>)
    const FOP_GT = '$gt';
//Operation Less Then (<)
    const FOP_LT = '$lt';
//Operation Greater Then or Equal (>=)
    const FOP_GTE = '$gte';
//Operation Less Then or Equal (<=)
    const FOP_LTE = '$lte';
//Operation Not Equal (!=,<>)
    const FOP_NOTEQUAL = '$ne';
//Operation In Array
    const FOP_IN = '$in';
//Operation Not In Array
    const FOP_NOTIN = '$nin';
//Operation Between
    const FOP_BETWEEN = '$btw';
//Operation All items of array must be in database
    const FOP_ALL = '$all';

    static function op ( $op, $data ) {
        switch ($op) {
            case self::FOP_GT:
            case self::FOP_LT:
            case self::FOP_GTE:
            case self::FOP_LTE:
            case self::FOP_NOTEQUAL: {
                    if (\func_num_args () !== 2) {
                        return false;
                    } else {
                        return array ($op => $data);
                    }
                    break;
                }
            case self::FOP_BETWEEN: {
                    if (\func_num_args () !== 3) {
                        return false;
                    } else {
                        return array ($op => array ($data, \func_get_arg ( 2 )));
                    }
                    break;
                }
            case self::FOP_IN:
            case self::FOP_NOTIN:
            case self::FOP_BETWEEN:
            case self::FOP_ALL: {
                    if (\func_num_args () !== 2 || false === \is_array ( $data )) {
                        return false;
                    } else {
                        return array ($op => (array) $data);
                    }
                    break;
                }
        }
        return null;
    }

}

class Storage {
    public $count = 0;
    public $allCount = 0;
    public $records = array ();

    public function getFirst () {
        if (count ( $this->records ) > 0 && key_exists ( 0, $this->records )) {
            return $this->records [0];
        } else {
            throw new \phpMyEngine\Exception ( \phpMyEngine\Exception::TYPE_ERROR, 'Record not found' );
        }
        return null;
    }

    public function __construct ( $array = null ) {
        if (is_array ( $array )) {
            for ($i = 0; $i < count ( $array ); $i++) {
                $this->records[$i] = $array[$i];
            }
            $this->count = $this->allCount = $i;
        }
        return null;
    }

}
namespace phpMyEngine\Records\Validate;

function validateInputData ( &$object, $name, $value ) {
    if (in_array ( $name, $object->getProperties () ) && $object->skipErrors == false) {
        $myValidateRules = $object->getValidateRules ();
        $object->$name = $value;
        $myMessages = new \phpMyEngine\Messages();
        $notRequired = isset ( $myValidateRules[$name]->formTag->notRequired ) &&
                $myValidateRules[$name]->formTag->notRequired === true;
        if (isset ( $myValidateRules[$name]->transformations )) {
            if (isset ( $myValidateRules[$name]->transformations->stripTags )) {
                if (isset ( $myValidateRules[$name]->transformations->allowedTags ) &&
                        is_array ( $myValidateRules[$name]->transformations->allowedTags )) {
                    $allowedTags = '<' . implode ( '>,<', $myValidateRules[$name]->transformations->allowedTags ) . '>';
                } else {
                    $allowedTags = null;
                }
                $object->$name = strip_tags ( $object->$name, $allowedTags );
            }
            if (isset ( $myValidateRules[$name]->transformations->htmlspecialchars )) {
                $object->$name = htmlspecialchars ( $object->$name );
            }
            if (isset ( $myValidateRules[$name]->transformations->toINT )) {
                $object->$name = (int) $object->$name;
            }
            if (isset ( $myValidateRules[$name]->transformations->pcre )) {
                $object->$name = preg_replace ( $myValidateRules[$name]->transformations->pcre, null, $object->$name );
            }
        }
        if (false === $notRequired) {
            $valueLength = strlen ( $object->$name );
            if (isset ( $myValidateRules[$name]->length->min ) && (int) $myValidateRules[$name]->length->min > 0) {
                if (true === $valueLength < (int) $myValidateRules[$name]->length->min) {
                    throw new \phpMyEngine\Exception ( \phpMyEngine\Exception::TYPE_ERROR,
                            'Min length of ' . $name . ' is ' . ((int) $myValidateRules[$name]->length->min) . ' now - ' . $valueLength );
                }
            }
            if (isset ( $myValidateRules[$name]->length->max ) && (int) $myValidateRules[$name]->length->max > 0) {
                if (true === $valueLength > (int) $myValidateRules[$name]->length->max) {
                    throw new \phpMyEngine\Exception ( \phpMyEngine\Exception::TYPE_ERROR,
                            'Max length of ' . $name . ' is . Now length is' );
                }
            }
            if (isset ( $myValidateRules[$name]->pcre ) && (int) strlen ( $myValidateRules[$name]->pcre ) > 0) {
                if (false === (bool) preg_match ( $myValidateRules[$name]->pcre, $object->$name )) {
                    throw new \phpMyEngine\Exception ( \phpMyEngine\Exception::TYPE_ERROR,
                            'Value of ' . $name . ' not equal format' );
                }
            }
        }
    }
    return null;
}