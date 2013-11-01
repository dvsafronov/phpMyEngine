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

use phpMyEngine\Config\Config;
const PME_RECORDS_COLLECTION = 'records';

class Mutagen {

    private $_validateRules = null, $_properties;
    private $_useDBProfile = '';

    public function __set($name, $value) {
        \phpMyEngine\Records\Validate\validateInputData($this, $name, $value);
        return null;
    }

    public function __get($name) {
        if (isset($this->$name)) {
            return $this->$name;
        }
        return null;
    }

    public function __construct($name = null, Array $data = null, $categoty = null) {
        if ($categoty === null) {
            $categoty = 'records';
        }
        if (true === \is_null($name)) {
            return null;
        }
        try {
            $this->loadModel($name, $categoty, $data);
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }

    final function loadModel($name, $cat, Array $data = null) {
        $_myCache = \phpMyEngine\Cache\Cache::getInstance();
        if (false === ($mutagenContent = $_myCache->getValue("__mutagen_{$cat}_{$name}"))) {
            if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath(\strtolower($name).'.mutagen.php', 'etc/mutagens/'.$cat)) {
                $mutagenContent = include($rp);
                $_myCache->setValue("__mutagen_{$cat}_{$name}", $mutagenContent, 12);
            } else {
                throw new \Exception('Mutagen '.$cat.'/'.$name.' not found');
            }
        }
        $validator = array();
        foreach ($mutagenContent as $key => $value) {
            switch ($key) {
                default:
                    {
                    $this->$key = null;
                    $this->_properties[] = $key;
                    $validator[$key] = $value;
                    break;
                    }
                case '_specialNotes':
                {
                    $this->_specialNotes = (array) $value;
                    break;
                }
            }
        }

        if ($this->_useDBProfile == '') {
            $this->_useDBProfile = Config::getInstance()->getMutagenDBProfile($name);
        }

        $this->_validateRules = $validator;
        $key = $value = null;
        if ($data !== null && is_array($data)) {
            foreach ($data as $key => $value) {
                if (in_array($key, $this->_properties)) {
                    $this->$key = $value;
                }
            }
        }

        return null;
    }

    public function getProperties() {
        return (array) $this->_properties;
    }

    public function getValidateRules() {
        return (array) $this->_validateRules;
    }

    public function getValues() {
        $result = array();
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

    private static $table = [
        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
        ['P', 'h', 'p', 'M', 'y', 'E', 'n', 'g', 'i', 'e']
    ];

    public function __construct($array = null) {
        $this->_id = (int) hexdec(\uniqid());
        try {
            $this->mutagenData = new Mutagen();
            if (isset($array) && is_array($array)) {
                foreach ($array as $key => $value) {
                    $this->$key = $value;
                }
            }
        } catch (\phpMyEngine\Exception $e) {

        }
    }

    public function getCreationTime($format = 'd.m.Y H:i:s') {
        return \phpMyEngine\getCreationTimeByID($this->_id, $format);
    }

    public function save() {
        $this->tags = isset($this->tags) ? implode(',', (array) $this->tags) : '';
        $dbProfile = Config::getInstance()->getMutagenDBProfile($this->mutagenType);
        $q = \phpMyEngine\Database\generateQuery((array) $this, PME_RECORDS_COLLECTION
            , \phpMyEngine\Database\REQUEST_TYPE_SAVE, false, $dbProfile);
        return \phpMyEngine\Database\doQuery($q, false, $dbProfile);
    }

    public function delete() {
        $dbProfile = Config::getInstance()->getMutagenDBProfile($this->mutagenType);
        $q = \phpMyEngine\Database\generateQuery((array) $this, PME_RECORDS_COLLECTION
            , \phpMyEngine\Database\REQUEST_TYPE_REMOVE, false, $dbProfile);
        return \phpMyEngine\Database\doQuery($q, false, $dbProfile);
    }

    public function upRating() {
        $this->ratingPositive++;
        return $this->save();
    }

    public function downRating() {
        $this->ratingNegative++;
        return $this->save();
    }

    public function incrementRequests() {
        $this->requests++;
        return $this->save();
    }

    public function applyMutagen($name, Array $data = null) {
        $this->mutagenType = $name;
        $this->mutagenData = new Mutagen(\strtolower($name));
    }

    static function cryptRecordInfo($recordInfo) {
        $hash = base64_encode($recordInfo);
        $crc = str_replace(self::$table[0], self::$table[1], (string) crc32($recordInfo));
        $crc = str_pad($crc, 12, 'w', STR_PAD_LEFT);
        $hash = strrev(str_rot13(strrev(str_replace('=', null, $hash)).$crc));
        if (isset(Config::getInstance()->engine->cryptRecordInfo)
            && isset(Config::getInstance()->engine->cryptRecordInfoKey)
            && Config::getInstance()->engine->cryptRecordInfo == true
        ) {
            $hash = base64_encode(mcrypt_encrypt(MCRYPT_CAST_128, Config::getInstance()->engine->cryptRecordInfoKey, $hash, MCRYPT_MODE_ECB));
        }
        return $hash;
    }

    static function decryptRecordInfo($str) {
        if (isset(Config::getInstance()->engine->cryptRecordInfo)
            && isset(Config::getInstance()->engine->cryptRecordInfoKey)
            && Config::getInstance()->engine->cryptRecordInfo == true
        ) {
            $str = mcrypt_decrypt(MCRYPT_CAST_128, Config::getInstance()->engine->cryptRecordInfoKey, base64_decode($str), MCRYPT_MODE_ECB);
        }
        $str = str_rot13(strrev($str));
        $crc = str_replace(self::$table[1], self::$table[0], str_replace('w', null, substr($str, -12)));
        $str = base64_decode(strrev(substr($str, 0, -12)).'=');
        return $crc === (string) crc32($str) ? $str : false;
    }

}

class Filter {

    const ORDER_DESC = -1;
    const ORDER_ASC = 1;
    const ORDER_RAND = 2;

    public $_id, $mutagenType, $status, $tags;
    public $ratingPositive, $ratingNegative;
    public $permissions, $requests;
    public $owner, $mutagenData;
    public $orderBy, $order;

    public function __construct($id = null) {
        foreach ($this as $key => $value) {
            $this->$key = null;
            $this->mutagenData = new \stdClass();
        }
        if ($id !== null && is_double($id)) {
            $this->_id = (int) $id;
        }
    }

    public function getRecords() {
        $filter = (array) $this;
        if (count((array) $filter['mutagenData']) == 0) {
            unset($filter['mutagenData']);
        }
        $dbProfile = Config::getInstance()->getMutagenDBProfile($filter['mutagenType']);
        $queryStr = \phpMyEngine\Database\generateQuery($filter, PME_RECORDS_COLLECTION, 0, false, $dbProfile);
        $myResult = \phpMyEngine\Database\doQuery($queryStr, false, $dbProfile);
        $ca = self::getCountByFilter($filter);

        $data = null;
        if ($ca) {
            $data = new \SplFixedArray($ca);
            for ($i = 0; $i < $ca; $i++) {
                if ($myResult[$i]['_id'] == 0) {
                    break;
                }

                $data[$i] = new Record($myResult[$i]);

                unset($myResult [$i]);
                try {
                    $data[$i]->mutagenData =
                        new Mutagen($data[$i]->mutagenType,
                            (array) $data[$i]->mutagenData);
                } catch (\Exception $myException) {

                }
            }
        }
        $myStorage = new Storage($data);
        unset($data, $myResult);
        return $myStorage;
    }

    public function deleteRecords() {
        $filter = (array) $this;
        if (count((array) $filter['mutagenData']) == 0) {
            unset($filter['mutagenData']);
        }
        $dbProfile = Config::getInstance()->getMutagenDBProfile($filter['mutagenType']);
        $queryStr = \phpMyEngine\Database\generateQuery($filter, PME_RECORDS_COLLECTION,
            \phpMyEngine\Database\REQUEST_TYPE_REMOVE, false, $dbProfile);

        $queryStr = \phpMyEngine\Database\generateQuery($filter, PME_RECORDS_COLLECTION, 2, false, $dbProfile);

        return \phpMyEngine\Database\doQuery($queryStr, false, $dbProfile);
    }

    private function getCountByFilter($filter) {
        unset($filter['limit'], $filter['offset'], $filter['order'], $filter['orderBy']);
        $dbProfile = Config::getInstance()->getMutagenDBProfile($filter['mutagenType']);
        $queryStr = \phpMyEngine\Database\generateQuery($filter, PME_RECORDS_COLLECTION,
            \phpMyEngine\Database\REQUEST_TYPE_COUNTBYFILTER, false, $dbProfile);
        $myResult = (array) \phpMyEngine\Database\doQuery($queryStr, false, $dbProfile);
        if (is_array($myResult[0])) {
            return array_key_exists('allcount', $myResult[0]) ? (int) $myResult[0]['allcount'] : 0;
        } else {
            return 0;
        }
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

    static function op($op, $data) {
        switch ($op) {
            case self::FOP_GT:
            case self::FOP_LT:
            case self::FOP_GTE:
            case self::FOP_LTE:
            case self::FOP_NOTEQUAL:
            {
                if (\func_num_args() !== 2) {
                    return false;
                } else {
                    return array($op => $data);
                }
                break;
            }
            case self::FOP_BETWEEN:
            {
                if (\func_num_args() !== 3) {
                    return false;
                } else {
                    return array($op => array($data, \func_get_arg(2)));
                }
                break;
            }
            case self::FOP_IN:
            case self::FOP_NOTIN:
            case self::FOP_ALL:
            {
                if (\func_num_args() !== 2 || false === \is_array($data)) {
                    return false;
                } else {
                    return array($op => (array) $data);
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
    public $records = [];

    public function getFirst() {
        if (count($this->records) > 0 && array_key_exists(0, $this->records)) {
            return $this->records [0];
        } else {
            throw new \phpMyEngine\Exception(\phpMyEngine\Exception::TYPE_ERROR, 'Record not found');
        }
        return null;
    }

    public function __construct($array = null) {
        if (is_array($array)) {
            $this->records = new \SplFixedArray(count($array));
            $this->records->fromArray($array);
            $this->count = $this->allCount = $this->records->count();
        } elseif ($array instanceof \SplFixedArray) {
            $this->records = $array;
            $this->count = $this->allCount = $this->records->count();
        }
        return null;
    }

    public function getIDs() {
        $list = $this->records;
        array_walk($list, function (&$item) {
            $item = (array) $item;
        });
        return \array_column($list, '_id');
    }

}


namespace phpMyEngine\Records\Validate;

function validateInputData(&$object, $name, $value) {
    if (in_array($name, $object->getProperties()) && $object->skipErrors == false) {
        $myValidateRules = $object->getValidateRules();
        $object->$name = $value;
        $myMessages = new \phpMyEngine\Messages();
        $notRequired = isset($myValidateRules[$name]->formTag->notRequired) &&
            $myValidateRules[$name]->formTag->notRequired === true;
        if (isset($myValidateRules[$name]->transformations)) {
            if (isset($myValidateRules[$name]->transformations->stripTags)) {
                if (isset($myValidateRules[$name]->transformations->allowedTags) &&
                    is_array($myValidateRules[$name]->transformations->allowedTags)
                ) {
                    $allowedTags = '<'.implode('>,<', $myValidateRules[$name]->transformations->allowedTags).'>';
                } else {
                    $allowedTags = null;
                }
                $object->$name = strip_tags($object->$name, $allowedTags);
            }
            if (isset($myValidateRules[$name]->transformations->htmlspecialchars)) {
                $object->$name = htmlspecialchars($object->$name);
            }
            if (isset($myValidateRules[$name]->transformations->toINT)) {
                $object->$name = (int) $object->$name;
            }
            if (isset($myValidateRules[$name]->transformations->pcre)) {
                $object->$name = preg_replace($myValidateRules[$name]->transformations->pcre, null, $object->$name);
            }
        }
        if (false === $notRequired) {
            $valueLength = strlen($object->$name);
            if (isset($myValidateRules[$name]->length->min) && (int) $myValidateRules[$name]->length->min > 0) {
                if (true === $valueLength < (int) $myValidateRules[$name]->length->min) {
                    throw new \phpMyEngine\Exception(\phpMyEngine\Exception::TYPE_ERROR,
                        'Минимальная длинна поля &laquo;'.$name.'&raquo; &mdash; '.((int) $myValidateRules[$name]->length->min).', сейчас &mdash; '.$valueLength);
                }
            }
            if (isset($myValidateRules[$name]->length->max) && (int) $myValidateRules[$name]->length->max > 0) {
                if (true === $valueLength > (int) $myValidateRules[$name]->length->max) {
                    throw new \phpMyEngine\Exception(\phpMyEngine\Exception::TYPE_ERROR,
                        'Минимальная длинна поля &laquo;'.$name.'&raquo; &mdash; '.$myValidateRules[$name]->length->max.'. Сейчас &mdash; '.$valueLength);
                }
            }
            if (isset($myValidateRules[$name]->pcre) && (int) strlen($myValidateRules[$name]->pcre) > 0) {
                if (false === (bool) preg_match($myValidateRules[$name]->pcre, $object->$name)) {
                    throw new \phpMyEngine\Exception(\phpMyEngine\Exception::TYPE_ERROR,
                        'Значение поля &laquo;'.$name.'&raquo; не соответсвует формату');
                }
            }
        }
    }
    return null;
}