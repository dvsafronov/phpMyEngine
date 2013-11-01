<?php

/**
 *
 * Библиотека работы с кешем phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-10-30 17:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */

namespace phpMyEngine\Cache;

class Cache {

    protected static $instance; // object instance
    private $_cache = false, $prefix, $type, $time = 0, $requests = 0;

    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        $_myConfig = new \phpMyEngine\Config\Config ();
        if (false == $_myConfig->engine->cache) {
            return null;
        }

        $tmpTime = \microtime(true);
        $_cacheProfile = $_myConfig->engine->cacheProfile;
        $_cacheProfile = $_myConfig->$_cacheProfile;
        $this->prefix = (isset($_cacheProfile->prefix)) ? $_cacheProfile->prefix : null;
        $this->type = $_cacheProfile->type;
        switch ($this->type) {
            case 'Memcache':
            {
                $this->_cache = new \Memcache();
                $this->_cache->connect($_cacheProfile->host, (int) $_cacheProfile->port);
                if (false == $this->_cache->getVersion()) {
                    $this->_cache = false;
                }
                break;
            }
            case 'filesDataStorage':
            {
                include_once 'lib/filesDataStorage/filesDataStorage.php';
                $folder = PATH_APPLICATION.'/var/cache/';
                $this->_cache = new \filesDataStorage\filesDataStorage($folder);
                break;
            }
            default :
                {
                $this->_cache = false;
                break;
                }
        }

        $this->time += \microtime(true) - $tmpTime;
        return null;
    }

    /**
     *
     * Сохраняет значение в кеше
     *
     * @param string $valueName
     * @param abstract $valueContent
     * @param int $periodMinutes
     * @return bool
     */
    public function setValue($valueName, $valueContent, $periodMinutes) {
        $result = false;
        $tmpTime = \microtime(true);
        if ($this->_cache !== false) {
            $this->requests++;
            switch ($this->type) {
                case 'Memcache':
                {
                    $result = $this->_cache->set($this->prefix.$valueName, $valueContent, false, $periodMinutes * 60);
                    break;
                }
                case 'filesDataStorage':
                {
                    $queryFilter = new \filesDataStorage\QueryFilter();
                    $data['_id'] = '_cache';
                    $queryFilter->setData($data);
                    $data = $this->_cache->selectCollection('_filesds')->get($queryFilter);
                    unset($queryFilter);
                    if (\is_array($data)) {
                        $data = $data[0];
                    } else {
                        $data['_id'] = '_cache';
                    }
                    $data[$valueName] = $valueContent;
                    $data['_fds_ttl'.$valueName] = $periodMinutes;
                    $data['_fds_crt'.$valueName] = time();
                    $result = $this->_cache->selectCollection('_filesds')->save($data);
                    break;
                }
            }
        }
        $this->time += \microtime(true) - $tmpTime;
        return $result;
    }

    /**
     *
     * Возвращает значение из кеша
     *
     * @param string $valueName
     */
    public function getValue($valueName) {
        $result = false;
        $tmpTime = \microtime(true);
        if ($this->_cache !== false) {
            $this->requests++;
            switch ($this->type) {
                case 'Memcache':
                {
                    $result = $this->_cache->get($this->prefix.$valueName);
                    break;
                }
                case 'filesDataStorage':
                {
                    $queryFilter = new \filesDataStorage\QueryFilter();
                    $data['_id'] = '_cache';
                    $queryFilter->setData($data);
                    $tmpRes = $this->_cache->selectCollection('_filesds')->get($queryFilter);
                    if (
                        isset($tmpRes[0][$valueName])
                        && isset($tmpRes[0]['_fds_ttl'.$valueName])
                        && isset($tmpRes[0]['_fds_crt'.$valueName])
                        && (time() - ($tmpRes[0]['_fds_crt'.$valueName])) < ($tmpRes[0]['_fds_ttl'.$valueName] * 60)
                    ) {
                        $result = $tmpRes[0][$valueName];
                    }
                    break;
                } //case fds
            } //switch
        } // cache enabled
        $this->time += \microtime(true) - $tmpTime;
        return $result;
    }

    public function getTime() {
        return $this->time;
    }

    public function getRequests() {
        return $this->requests;
    }

}