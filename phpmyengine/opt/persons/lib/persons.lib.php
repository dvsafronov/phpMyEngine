<?php

/**
 * Библиотека пользовательских классов и функций phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace phpMyEngine\Persons;

const PME_RECORDS_COLLECTION = 'persons';

class Storage extends \phpMyEngine\Records\Storage {

}

class FilterOperation extends \phpMyEngine\Records\FilterOperation {

}

class Person {
    const STATUS_BLOCKED = 1;
    const STATUS_SUPERVISION = 2;
    const STATUS_VIP = 3;
    const STATUS_DELETED = 4;
    const STATUS_OK = 0;

// Свойства
    public $_id, $status = self::STATUS_OK;
    public $login, $password;
    public $ratingPositive = 0, $ratingNegative = 0;
    public $profileType = null, $profileData;
    public $visits, $lastVisit;
}

class Filter {
    const ORDER_DESC = - 1;
    const ORDER_ASC = 1;
    const ORDER_RAND = 2;

    public $_id, $status;
    public $login, $password;
    public $ratingPositive = 0, $ratingNegative = 0;
    public $profileType = null, $profileData;
    public $visits, $lastVisit;

    public function __construct ( $id = null ) {
        foreach ($this as $key => $value) {
            $this->$key = null;
            $this->profileData = new \stdClass();
        }
        if ($id !== null && is_double ( $id )) {
            $this->_id = (double) $id;
        }
    }

    public function getPersons () {
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
                    $myStorage->records[$i]->profileData =
                            new Mutagen ( $myStorage->records[$i]->profileType,
                                    (array) $myStorage->records[$i]->profileData );
                } catch (\phpMyEngine\Exception $myException) {

                }
            }
            $myStorage->count = $i;
        }
        return $myStorage;
    }

    public function deletePersons () {
        $filter = (array) $this;
        if (count ( (array) $filter['mutagenData'] ) == 0) {
            unset ( $filter['mutagenData'] );
        }
        $queryStr = \phpMyEngine\Database\generateQuery ( $filter, PME_RECORDS_COLLECTION, \phpMyEngine\Database\REQUEST_TYPE_REMOVE );
        return \phpMyEngine\Database\doQuery ( $queryStr );
    }

}

class Profile extends \phpMyEngine\Records\Mutagen {

    public function __construct ( $name = null, Array $data = null ) {
        if (true === \is_null ( $name )) {
            return null;
        }
        $this->loadModel ( $name, 'persons' );
        return null;
    }

}