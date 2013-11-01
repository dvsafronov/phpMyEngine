<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 01.11.13
 * Time: 4:58
 */



/**
 *
 * Библиотека работы с конфигурацией phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */

namespace phpMyEngine\Config;

use \phpMyEngine;
use \phpMyEngine\EngineFileSystem;

class Config {

    protected static $instance; // object instance
    private $_data = array();
    private $_optData = array();

    public static function &getInstance($name = null) {
        if (self::$instance === null) {
            self::$instance = new self($name);
        }
        return self::$instance;
    }

    public function __set($name, $value) {
        if ($name === 'opt') {
            $key = key($value);
            $this->_optData[$key] = $value->$key;
        } else {
            $this->_data [$name] = $value;
        }
        return null;
    }

    public function __get($name) {
        if ($name === 'opt') {
            if (isset($this->_optData)) {
                return (object) $this->_optData;
            }
        } else {
            if (isset($this->_data [$name])) {
                return $this->_data [$name];
            }
        }
        return null;
    }

    public function __construct($name = null) {
        if ($name == null) {
            $name = 'phpmyengine';
        }
        $this->load($name);
        return null;
    }

    public function load($config, $fromOPT = false) {
        // специальная проверка, на случай загрузки конфига кеша.
        // если убрать - получим вечный цикл
        if ($config == 'phpmyengine') {
            $rp = \phpMyEngine\PME_SITE_DIR.'/etc/config/'.$config.'.config.php';
            if (false === file_exists($rp)) {
                \phpMyEngine\logError("Main config file not found at {$rp}", true);
            }
        } else {
            $_myStructure = EngineFileSystem\Structure::getInstance();
            $rp = EngineFileSystem\getRealFilePath($config.'.config.php', 'etc/config');
        }

        if (false !== $rp) {
            $configContent = include($rp);

            if ($fromOPT == true) {
                $curConf = new \stdClass();
                $curConf->$configCategory = new \stdClass();
                foreach ($configContent as $group => $value) {
                    if (is_array($value)) {
                        $value = (object) $value;
                    }
                    $curConf->$configCategory->$group = $value;
                }
                $this->opt = $curConf;
            } else {
                foreach ($configContent as $group => $value) {
                    if (is_array($value)) {
                        $value = (object) $value;
                    }
                    $this->$group = $value;
                }
            }

        }
        if ($fromOPT == true) {
            return isset($this->opt->$config) ? $this->opt->$config : new Config();
        }
        return null;
    }

    public function getMutagenDBProfile($mutagen, $default = '') {
        $mutagen = strtolower($mutagen);
        if (!isset($this->_data['mutagensDBProfiles'])
            || !isset($this->_data['mutagensDBProfiles']->$mutagen)
        ) {
            return $default ? : $this->_data['engine']->databaseProfile;
        }
        return $this->_data['mutagensDBProfiles']->$mutagen;
    }

}