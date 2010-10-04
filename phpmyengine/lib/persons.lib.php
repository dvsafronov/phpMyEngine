<?php
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
    public $ratingPositive = 0, $ratingNegative = 0;
    public $profileType = null, $profileData;
    public $visits, $lastVisit;
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