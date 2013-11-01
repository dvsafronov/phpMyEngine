<?php

/**
 *
 * Библиотека для обеспечения работы драйверов баз данных phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2013-07-05 21:28
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */

namespace phpMyEngine\Database;

//Types of request to database

const REQUEST_TYPE_QUERY = 0;
const REQUEST_TYPE_SAVE = 1;
const REQUEST_TYPE_REMOVE = 2;
const REQUEST_TYPE_COUNTBYFILTER = -1;

/**
 *
 * Обновляет статистику использования базы данных
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 * @param float $time
 * @param bool $errorFlag
 */
function updateStatistics($time, $errorFlag = false, $dbProfile) {
    $valName = $errorFlag == true ? 'countErrorQueries' : 'countQueries';
    $_db = Statistic::getInstance();
    $_db = isset($_db[$dbProfile]) ? $_db[$dbProfile] : new StatisticItem();
    $_db->time += (float) $time;
    $_db->$valName++;
    Statistic::getInstance()[$dbProfile] = $_db;
    return null;
}

/**
 *
 * Вызывает функцию генерации запрос к базе данных основываясь
 * на ассоциативном массиве, содержащим данные
 * в виде "поле" = "значение" (фильтре),
 *
 * @param $filter - ассоциативный массив в виде "поле" = "значение"
 * @param $collection - коллекция или таблица над которой будут производиться
 * действия
 * @param $type - тип запроса к базе данных
 */
function generateQuery(array $filter, $collection, $type = REQUEST_TYPE_QUERY, $ignoreMutageType = false, $dbProfile = null) {
    $dbProfile = $dbProfile == null
        ? \phpMyEngine\Config\Config::getInstance()->engine->databaseProfile
        : $dbProfile;
    $curDBProfile = \phpMyEngine\Config\Config::getInstance()->$dbProfile;
    if (checkDriver($curDBProfile->type)) {
        $cmd = '\\'.__NAMESPACE__.'\\'.$curDBProfile->type.'\\generateQuery';
        return $cmd($filter, $collection, $type, $ignoreMutageType, $dbProfile);
    } else {
        return false;
    }
}

function checkDriver($dbType, $ite = 0) {
    if ($ite >= 2) {
        \phpMyEngine\logError('Unable to load database driver');
        return false;
    }
    if (false !== \phpMyEngine\functionExists('\phpMyEngine\Database\\'.$dbType.'\generateQuery')) {
        return true;
    } else {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath(strtolower($dbType).'.dbdriver.php', 'lib')) {
            $ite++;
            include_once $rp;
            return checkDriver($dbType, $ite);
        } else {
            die('DB Driver not found');
            return false;
        }
    }
}

/**
 *
 * Вызывает функцию выполнения запроса
 *
 * @param string $queryStr - сгенерированный запрос к хранилищу данных
 * @param bool $uncacheble - принудительное отключение кеша
 * @param string $dbProfile - профиль подключения к БД
 * @return bool|mixed
 */

function doQuery($queryStr, $uncacheble = false, $dbProfile = null) {
    \phpMyEngine\logError($queryStr);
    $dbProfile = $dbProfile == null
        ? \phpMyEngine\Config\Config::getInstance()->engine->databaseProfile
        : $dbProfile;

    $_myCache = \phpMyEngine\Cache\Cache::getInstance();
    $queryHash = urlencode($queryStr);

    if (false === ($result = $_myCache->getValue("__dbquery_{$queryHash}")) || $uncacheble == true) {
        $curDBProfile = \phpMyEngine\Config\Config::getInstance()->$dbProfile;
        if (checkDriver($curDBProfile->type)) {
            $cuTime = microtime(1);
            $cmd = '\\'.__NAMESPACE__.'\\'.$curDBProfile->type.'\\doQuery';
            $result = $cmd($queryStr, $dbProfile);
            $cuTime = microtime(1) - $cuTime;
            $errorFlag = $result !== false ? $errorFlag = false : $errorFlag = true;
            updateStatistics($cuTime, $errorFlag, $dbProfile);
            if ($errorFlag == true) {
                \phpMyEngine\logError('Error query - '.$queryStr);
            }
            $_myCache->setValue("__dbquery_{$queryHash}", $result, (1 / 60) * 5);
            return $result;
        }
        return false;
    }
    return $result;
}

/**
 * Класс-хранилище информации о соединение с БД
 */
final class Storage {

    public $_db = [];
    protected static $instance; // object instance

    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

}

final class StatisticItem {
    public $countQueries = 0;
    public $countErrorQueries = 0;
    public $time = 0;
}

final class Statistic {
    private $_db = [];
    protected static $instance; // object instance
    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance->_db;
    }
}