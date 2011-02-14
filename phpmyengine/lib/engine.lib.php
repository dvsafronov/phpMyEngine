<?php

/**
 * 
 * Библиотека основных функций и классов phpMyEngine
 * 
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010 
 * @version 2010-09-11 15:58 
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace phpMyEngine;

class Exception extends \Exception {
    const TYPE_ERROR = 1;
    const TYPE_WARNING = 2;
    const TYPE_HINT = 3;
    public $caErrors, $caWarnings, $caHints, $text;

    public function __construct ( $type = null, $message = null ) {
        if (null !== $type && null !== $message) {
            switch ($type) {
                case self::TYPE_ERROR : {
                        $this->caErrors++;
                        break;
                    }
                case self::TYPE_WARNING : {
                        $this->caWarnings++;
                        break;
                    }
                case self::TYPE_HINT : {
                        $this->caHints++;
                        break;
                    }
                default: {
                        break 2;
                    }
            }
            $this->text = $message;
        }
        return null;
    }

}

class Messages {
    public $errors = array ();
    public $messages = array ();
    public $warnings = array ();
    public $caErrors, $caWarnings, $caMessages;

    public function addError ( $text ) {
        array_push ( $this->errors, $text );
        $this->caErrors = $this->caErrors + 1;
    }

    public function addMessage ( $text ) {
        array_push ( $this->messages, $text );
        $this->caMessages = $this->caMessages + 1;
    }

    public function addWarning ( $text ) {
        array_push ( $this->warnings, $text );
        $this->caWarnings = $this->caWarnings + 1;
    }

    public function export () {

    }

}

function logError ( $desc, $hold = false ) {
    $e = date ( 'H:i:s' ) . "\t" . $_SERVER ['REQUEST_URI'] . "\t" . $_SERVER ['REMOTE_ADDR'] . "\t" . $desc . PHP_EOL;
    file_put_contents ( dirname ( __DIR__ ) . '/var/logs/' . date ( 'dmY' ) . '.log', $e, FILE_APPEND );
    if ($hold == true) {
        if (\DEBUG != 1) {
            $desc = "Fatal Error. Check engine ;)";
        }
        die ( $desc );
    }
}

function doRedirect ( $url ) {
    return header ( 'Location: ' . $url );
}

function loadModule ( $name ) {
    if (false !== $rp = EngineFileSystem\getRealFilePath ( $name . '.lib.php', 'usr/lib' )) {
        include_once $rp;
    }
    return null;
}

/**
 * 
 * Функция проверяет, было ли обращение к приложению выполнено
 * с использованием AJAX.
 * 
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 * 
 * @return bool
 * 
 */
function isAJAXRequest () {
    if (key_exists ( 'HTTP_X_REQUESTED_WITH', $_SERVER )) {
        return $_SERVER ['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }
    return false;
}

/**
 *
 * Функция запускает контроллер
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 * 
 * @param <type> $name
 */
function runController () {
    $_myConfig = Config\Config::getInstance ();
    $_myRoute = Route::getInstance ();
    if ($_myRoute->controller === false) {
        $_myRoute->controller = $_myConfig->engine->defaultController;
    }
    $path = $_myRoute->isControlPanel () ? 'sbin' : 'bin';
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $_myRoute->controller . '.php', 'usr/' . $path )) {
        include_once $rp;
        $func = '\phpMyEngine\\' . $_myRoute->controller . 'Controller\\' . $_myRoute->action . 'Action';
        if (\function_exists ( $func )) {
            $func();
        } else {
            $func = '\phpMyEngine\\' . $_myRoute->controller . 'Controller\\' . 'defaultAction';
            if (\function_exists ( $func )) {
                $func();
            } else {
                echo $func;
            }
        }
    }
    return null;
}

/**
 * Класс маршрутизации.
 * 
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
class Route {
    protected static $instance; // object instance
    public $controller, $page, $action;
    private $_controlpanel = false;

    public function isControlPanel () {
        return $this->_controlpanel;
    }

    public static function &getInstance () {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

    private function __construct () {
        $this->parseRequest ();
        return null;
    }

    /**
     * Парсинг запроса, поиск нужного контроллера, заполнение данных маршрута
     * @return NULL
     */
    private function parseRequest () {
        $_myConfig = \phpMyEngine\Config\Config::getInstance();
        $seporator = '/';
        $request = \urldecode ( $_SERVER ['REQUEST_URI'] );
        if (isset ( $_myConfig->controlPanel->host )) {
            if ($_SERVER['HTTP_HOST'] == $_myConfig->controlPanel->host) {
                $_myConfig->controlPanel->URI = 'http://' . $_SERVER['HTTP_HOST'];
                $this->_controlpanel = true;
            }
        } elseif (isset ( $_myConfig->controlPanel->virtualController )) {
            $_vcp = $_myConfig->controlPanel->virtualController;
            if (\substr ( $request, 0, strlen ( $_vcp ) + 2 ) == '/' . $_vcp . '/') {
                $request = \substr ( $request, strlen ( $_vcp ) + 1 );
                $this->_controlpanel = true;
                $_myConfig->controlPanel->URI = '/' . $_vcp;
                unset ( $_vcp );
            }
        }
        if ($this->_controlpanel == true) {
            \phpMyEngine\Config\Config::getInstance()->engine->design = 'controlpanel';
            $mySt = \phpMyEngine\EngineFileSystem\Structure::getInstance();
            Render\Render::getInstance()->Smarty ()->template_dir = $mySt['usr/templates/controlpanel'];
            if (\phpMyEngine\ControlPanel\isAuth() === false && $this->controller != 'cpauth') {
                $this->controller = 'cpauth';
                $this->action = null;
                \phpMyEngine\Render\Render::getInstance()->monopolyView = true;
                return null;
            }
        }
// всё, что до первого сепоратора - есть имя контроллера
        $this->controller = substr ( $request, 1 );
        if (strpos ( $this->controller, $seporator )) {
            $this->controller = \substr ( $this->controller, 0, strpos ( $this->controller, $seporator ) );
        }
// всё, что после последнего сепоратора - есть страницы номер.
// если явно указано page - его трём и оставляем цифрки, всё остальное - нуль
        if (substr ( $request, strrpos ( $request, $seporator ) + 1, 4 ) == 'page') {
            $this->page = (int) str_replace ( 'page', null, substr ( $request, strrpos ( $request, $seporator, 1 ) + 1 ) );
        }
// убираем уже известные нам данные
        $request = substr ( $request, strlen ( $this->controller ) + 2 );
        if (substr ( $request, \strlen ( $request ) - 1 ) == $seporator) {
            $request = \substr ( $request, 0, -1 );
        }
// подгружаем паттерны
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $this->controller . '.json', 'etc/routerrules' )) {
            $patterns = \json_decode ( \file_get_contents ( $rp ), true );
// производим проверку на соответствие паттернам
            if (is_array ( $patterns )) {
                $matches = null;
                foreach ($patterns as $rule) {
                    if (preg_match ( $rule['pcre'], $request, $matches )) {
                        for ($i = 1, $ca = count ( $matches ); $i < $ca; $i++) {
                            $rule['result'] = str_replace ( '$' . $i, $matches [$i], $rule['result'] );
                        }
                        $rule['result'] = explode ( ';', $rule['result'] );
                        for ($i = 0, $ca = count ( $rule['result'] ); $i < $ca; $i++) {
                            $tmp = explode ( '=', $rule['result'] [$i] );
                            $this->$tmp [0] = $tmp [1];
                        }
                        unset ( $rule['result'], $matches, $tmp, $ca );
                        break;
                    }
                }
            }
        }
        unset ( $patterns, $seporator, $request );
        return null;
    }

}

/**
 * 
 * Набор функций и классов для работы с внутренней файловой системой приложения
 * 
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace phpMyEngine\EngineFileSystem;

/**
 * 
 * Возвращяет массив с отношением виртуальных путей с реальными
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
class Structure {
    protected static $instance; // object instance
    private $structure = array ();

    public static function &getInstance () {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance->structure;
    }

    private function __construct () {
        $_myCache = \phpMyEngine\Cache\Cache::getInstance();
        if (false === ($this->structure = $_myCache->getValue ( '__mystructure' ))) {
            $this->getFilesList ( dirname ( __DIR__ ), $this->structure );
            $_myCache->setValue ( '__mystructure', $this->structure, 10 );
        }
        return null;
    }

    /**
     *
     * Функция сканирует дерево файлов, объединяя директорию дополнений
     * с общей структурой.
     * Возвращает многомерный массив
     *
     * @param string $path
     * @return array
     */
    private function getFilesList ( $dirname, &$output ) {
        $iterator = new \RecursiveDirectoryIterator ( $dirname );
        while ($iterator->valid ()) {
            if (false === $iterator->isDot ()) {
                if ($iterator->isDir ()) {
                    $func = __FUNCTION__;
                    self::$func ( $iterator->key (), $output );
                    $key = \str_replace ( dirname ( __DIR__ ) . '/', null, $iterator->getFileInfo () );
                    if (substr ( $key, 0, 4 ) == 'opt/') {
                        $key = substr ( $key, \strpos ( $key, '/', 4 ) + 1 );
                    }
                    if ($iterator->getPath () != dirname ( __DIR__ ) . '/opt' && $key != 'opt') {
                        $output[$key][] = $iterator->key ();
                    }
                }
            }
            $iterator->next ();
        }
        return null;
    }

}

/**
 * 
 * Производит проверку на существование файла по его виртуальному пути
 * 
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 * 
 * @param filename $file, path $path
 */
function getRealFilePath ( $file, $path ) {
    $_myStrucutre = Structure::getInstance ();
    if (\key_exists ( $path, $_myStrucutre )) {
        for ($i = 0, $ca = count ( $_myStrucutre[$path] ); $i < $ca; $i++) {
            if (\file_exists ( $_myStrucutre [$path][$i] . '/' . $file )) {
                return $_myStrucutre [$path][$i] . '/' . $file;
            }
        }
    }
    return false;
}

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

use \phpMyEngine\EngineFileSystem;

class Config {
    protected static $instance; // object instance
    private $_data = array ();

    public static function &getInstance ( $name = null ) {
        if (self::$instance === null) {
            self::$instance = new self ( $name );
        }
        return self::$instance;
    }

    public function __set ( $name, $value ) {
        $this->_data [$name] = $value;
        return null;
    }

    public function __get ( $name ) {
        if (isset ( $this->_data [$name] )) {
            return $this->_data [$name];
        } else {
            return null;
        }
    }

    public function __construct ( $name = null ) {
        if ($name == null) {
            $name = 'phpmyengine';
        }
        $this->load ( $name );
        return null;
    }

    public function load ( $configFile ) {
// специальная проверка, на случай загрузки конфига кеша.
// если убрать - получим вечный цикл
        $rp = dirname ( __DIR__ ) . '/etc/config/' . $configFile . '.json';
        if (false === \file_exists ( $rp )) {
            $_myStructure = EngineFileSystem\Structure::getInstance ();
            $rp = EngineFileSystem\getRealFilePath ( $configFile . '.json', 'etc/config' );
        }
        if (false !== $rp) {
            $configContent = json_decode ( \file_get_contents ( $rp ) );
            if (JSON_ERROR_NONE !== json_last_error ()) {
                die ( 'Config file malformed' );
            } else {
                foreach ($configContent as $group => $value) {
                    $this->$group = $value;
                }
            }
        }
    }

}
namespace phpMyEngine\ControlPanel;

use phpMyEngine\Config\Config;

function isAuth () {
    if (!isset ( $_SESSION['SID'] )) {
        session_start();
        $_SESSION['SID'] = session_id();
    }
    return
    isset ( $_SESSION['_cplogin'] )
    && isset ( $_SESSION['_cppasshash'] )
    && $_SESSION['_cplogin'] == Config::getInstance()->controlPanel->login
    && $_SESSION['_cppasshash'] == sha1 ( Config::getInstance()->controlPanel->password );
}

function doQuit () {
    return $_SESSION['_cplogin'] = $_SESSION['_cppasshash'] = null;
}

function doAuth ( $login, $password ) {
    $_referenceAuth[] = Config::getInstance()->controlPanel->login;
    $_referenceAuth[] = sha1 ( Config::getInstance()->controlPanel->password );
// have a nice day ;)
    if ((bool) ((int) array_diff ( array ($login, sha1 ( $password )), $_referenceAuth ) - 1)) {
        if (!isset ( $_SESSION['SID'] )) {
            session_start();
            $_SESSION['SID'] = session_id();
        }
        $_SESSION['_cplogin'] = $login;
        $_SESSION['_cppasshash'] = sha1 ( $password );
        return true;
    }
    return false;
}
namespace phpMyEngine\HTML;

class FormElement {
    public $id;
    public $type;
    public $name;
    public $value;
    public $maxLength;
    public $selected;
    public $readonly;
    public $disabled;
    public $multiple;
    public $rows;
    public $notRequired;

    public function __construct ( $formTag = null ) {
        if (is_object ( $formTag )) {
            foreach ($formTag as $key => $value) {
                $this->$key = $value;
            }
        }
        return null;
    }

    public function __toString () {
        if (in_array ( $this->type, array ('text', 'checkbox', 'radio', 'select', 'textarea', 'hidden') )) {
            $strID = $strType = $strName = $strValue = $strMaxLength =
                    $strSelected = $strReadonly = $strDisabled = $strMultiple = null;
            if (strlen ( $this->id ) > 0) {
                $strID = ' id="' . $this->id . '" ';
            }
            if (strlen ( $this->name ) > 0) {
                $strName = ' name="' . $this->name . '" ';
            }
            if ($this->readonly == true) {
                $strReadonly = ' readonly ';
            }
            if ($this->disabled == true) {
                $strDisabled = ' readonly ';
            }
            if ($this->selected == true) {
                if ($this->type == 'select' || $this->type == 'radio') {
                    $strSelected = ' selected = "selected" ';
                }
                if ($this->type == 'checkbox') {
                    $strSelected = ' checked = "checked" ';
                }
            }
            if ($this->type == 'text') {
                if ((int) $this->maxLength > 0) {
                    $strMaxLength = ' maxlength="' . (int) $this->maxLength . '" ';
                }
            }
            if ($this->type == 'textarea') {
                if ((int) $this->rows > 0) {
                    $strMaxLength = ' rows="' . (int) $this->rows . '" ';
                }
                $strValue = '>' . $this->value . '</textarea';
            }
            if ($this->type == 'select') {
                if ($this->multiple == true) {
                    $strMultiple = ' multiple';
                }
                if (isset ( $this->options ) && \is_string ( $this->options ) &&
                        preg_match ( '/^\$\((.*)\)$/i', (string) $this->options, $matches )) {
                    $callFunc = '\phpMyEngine\Modules\\' . \str_replace ( '/', '\\', $matches[1] );
                    if (function_exists ( $callFunc )) {
                        $this->options = $callFunc();
                    } else {
                        \phpMyEngine\logError ( $callFunc . " doesn't exists!" );
                        $this->options = null;
                    }
                }
                $strOptions = null;
                if (isset ( $this->options ) && is_array ( $this->options ) === false) {
                    $this->options = null;
                } else {
                    foreach ($this->options as $key => $value) {
                        $selected = $value == $this->value ? ' selected="selected" ' : '';
                        $strOptions .= '<option value="' . $value . '"' . $selected . '>' . $key . '</option>' . PHP_EOL;
                    }
                }

                $strValue = '>' . $strOptions . '</select';
            }
            if ($strValue == null) {
                $strValue = ' value="' . $this->value . '" ';
            }
            if ($this->type == 'text' || $this->type == 'radio' || $this->type == 'checkbox') {
                $strType = 'input type="' . $this->type . '" ';
            } else {
                $strType = $this->type;
            }
            if ($this->type == 'hidden') {
                $strType = 'input type="hidden" ';
            }
            $formElement = '<' . $strType . $strID . $strName . $strReadonly . $strMaxLength .
                    $strDisabled . $strMultiple . $strValue . '>';
            return $formElement;
        } else {
            /* код ниже ничего не делает */
            $_myStructure = \phpMyEngine\EngineFileSystem\Structure::getInstance();
            if (\phpMyEngine\EngineFileSystem\fileExists ( 'etc/formelements/' . \strtolower ( $this->type ) . '.tpl' )) {
                \ob_start();
                if (isset ( $this->options ) && \is_string ( $this->options ) &&
                        preg_match ( '/^_\((.*)\)$/i', (string) $this->options, $matches )) {
                    $callFunc = '\phpMyEngine\\' . \str_replace ( '/', '\\', $matches[1] );
                    if (function_exists ( $callFunc )) {
                        $this->options = $callFunc();
                    } else {
                        \phpMyEgine\logError ( $callFunc . " doesn't exists!" );
                        $this->options = null;
                    }
                }
                if (isset ( $this->options ) && is_array ( $this->options ) === false) {
                    $this->options = null;
                }
                $formElement = \ob_get_contents();
                \ob_end_clean();
                return $formElement;
            }
            \phpMyEgine\logError ( "Unknow tag - {$this->type}!" );
            return 'Unknow tag';
        }
    }

}
namespace phpMyEngine\Render;

function resetOutput () {
    ob_end_clean();
    return null;
}

class Render {
    const TITLE_PREPEND = 1;
    const TITLE_APPEND = 2;
    const TITLE_REPLACE = 0;
    private $_smarty;
    private $_css = array ();
    private $content, $situation, $title;
    public $monopolyView, $module, $rssLink;
    protected static $instance; // object instance

    public static function &getInstance () {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        if (\ob_get_status() == false) {
            \ob_start();
        }
        return self::$instance;
    }

    private function __construct () {
        include_once 'lib/smarty/Smarty.class.php';
        $this->_smarty = new \Smarty();
        $this->_smarty->debugging = false;
        $this->_smarty->allow_php_tag = false;
        $this->_smarty->caching = false;
        $this->_smarty->error_reporting = true;
        $this->_smarty->cache_lifetime = 12;
        $_myConfig = \phpMyEngine\Config\Config::getInstance ();
        $mySt = \phpMyEngine\EngineFileSystem\Structure::getInstance();
        $this->_smarty->template_dir = $mySt['usr/templates/' . $_myConfig->engine->design];
        $this->_smarty->compile_dir = realpath ( __DIR__ . '/../var/cache/compiledtemplates/' );
        $this->_smarty->cache_dir = realpath ( __DIR__ . '/../var/cache/' );
        $this->_smarty->plugins_dir[] = realpath ( __DIR__ . '/smartyplugins' ) . '/';
        return null;
    }

    public function Smarty () {
        return $this->_smarty;
    }

    public function getOutput () {
        $this->content = \ob_get_clean();
        if (\defined ( 'DEBUG' ) && DEBUG == true) {
            $this->htmlsize = strlen ( $this->content );
        }
        return null;
    }

    public function renderTemplate ( $name, $toVar = false ) {
        try {
            if ($toVar === true) {
                \ob_start();
            }
            $this->_smarty->display ( $name );
            if ($toVar === true) {
                return \ob_get_clean();
            }
        } catch (\Exception $e) {
            $file = \str_replace ( dirname ( __DIR__ ) . '/', null, $e->getFile () );
            \phpMyEngine\logError ( $e->getMessage () . ' (' . $file . ')' );
        }
        return null;
    }

    public function setValue ( $valName, $valContent ) {
        $this->_smarty->assign ( $valName, $valContent );
    }

    private function prepareContent () {
        $this->content = \str_replace ( '<title></title>', "<title>{$this->title}</title>", $this->content );
        $this->applyCSS();
        return null;
    }

    public function show () {
        $this->prepareContent();
        echo $this->content;
    }

    public function setTitle ( $text, $replacmentType = self::TITLE_REPLACE ) {
        switch ($replacmentType) {
            case self::TITLE_REPLACE: {
                    $this->title = $text;
                    break;
                }
            case self::TITLE_APPEND: {
                    if (strlen ( $this->title ) > 0) {
                        $this->title = $this->title . " / ";
                    }
                    $this->title .= $text;
                    break;
                }
            case self::TITLE_PREPEND: {
                    $this->title = $text . " / " . $this->title;
                    break;
                }
        }
    }

    public function applyDebugInfo ( $text ) {
        $this->content = \str_replace ( '<!--phpMyEngine::debugInfo/-->', $text, $this->content );
    }

    public function addCSS ( $file ) {
        \array_push ( $this->_css, $file );
        return null;
    }

    private function applyCSS () {
        $cssContent = null;
        for ($i = 0,$ca = count($this->_css); $i < $ca; $i++ ) {
            $cssContent .= '<link rel="stylesheet" type="text/css" href="' . $this->_css[$i] . '" />'.\PHP_EOL;            
        }
        $this->content = \str_replace ( '</head>', "{$cssContent}\r\n</head>", $this->content );
    }

}

/**
 *
 * Библиотека для обеспечения работы драйверов баз данных phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 2010-09-11 15:58
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
namespace phpMyEngine\Database;

//Types of request to database
const REQUEST_TYPE_QUERY = 0;
const REQUEST_TYPE_SAVE = 1;
const REQUEST_TYPE_REMOVE = 2;

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
function updateStatatistics ( $time, $errorFlag = false ) {
    $valName = $errorFlag == true ? 'countErrorQueries' : 'countQueries';
    $_storage = Storage::getInstance ();
    $_storage->time += (float) $time;
    $_storage->$valName++;
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
function generateQuery ( array $filter, $collection, $type = REQUEST_TYPE_QUERY ) {
    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $curDBProfile = $_myConfig->engine->databaseProfile;
    if (checkDriver ( $_myConfig->$curDBProfile->type )) {
        $cmd = '\\' . __NAMESPACE__ . '\\' . $_myConfig->$curDBProfile->type . '\\generateQuery';
        return $cmd ( $filter, $collection, $type );
    } else {
        return false;
    }
}

function checkDriver ( $dbType, $ite = 0 ) {
    if ($ite >= 2) {
        \phpMyEngine\logError ( 'Unable to load database driver' );
        return false;
    }
    if (false !== function_exists ( '\phpMyEngine\Database\\' . $dbType . '\generateQuery' )) {
        return true;
    } else {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( strtolower ( $dbType ) . '.dbdriver.php', 'lib' )) {
            $ite++;
            include_once $rp;
            return checkDriver ( $dbType, $ite );
        } else {
            die ( 'DB Driver not found' );
            return false;
        }
    }
}

/**
 *
 * Вызывает функцию выполнения запроса
 *
 * @param $queryStr - сгенерированный запрос к хранилищу данных
 */
function doQuery ( $queryStr ) {
    $_myConfig = \phpMyEngine\Config\Config::getInstance ();
    $curDBProfile = $_myConfig->engine->databaseProfile;
    if (checkDriver ( $_myConfig->$curDBProfile->type )) {
        $cuTime = microtime ( 1 );
        $cmd = '\\' . __NAMESPACE__ . '\\' . $_myConfig->$curDBProfile->type . '\\doQuery';
        $result = $cmd ( $queryStr );
        $cuTime = microtime ( 1 ) - $cuTime;
        $errorFlag = $result != false ? $errorFlag = false : $errorFlag = true;
        updateStatatistics ( $cuTime, $errorFlag );
        if ($errorFlag == true) {
//logError ( 'Error query - ' . $queryStr );
        }
        return $result;
    }
    return false;
}

/**
 * Класс-хранилище информации о соединение с БД
 */
final class Storage {
    public $countQueries = 0;
    public $countErrorQueries = 0;
    public $time = 0;
    public $_connection = null;
    protected static $instance; // object instance

    public static function &getInstance () {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

}

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

    public static function &getInstance () {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct () {
        $_myConfig = new \phpMyEngine\Config\Config ();
        if (false == $_myConfig->engine->cache) {
            return null;
        } else {
            $tmpTime = \microtime ( true );
            $_cacheProfile = $_myConfig->engine->cacheProfile;
            $_cacheProfile = $_myConfig->$_cacheProfile;
            $this->prefix = (isset ( $_cacheProfile->prefix )) ? $_cacheProfile->prefix : null;
            $this->type = $_cacheProfile->type;
            switch ($this->type) {
                case 'Memcached': {
                        $this->_cache = new \Memcache();
                        $this->_cache->connect ( $_cacheProfile->host, (int) $_cacheProfile->port );
                        if (false == $this->_cache->getVersion ()) {
                            $this->_cache = false;
                        }
                        break;
                    }
                case 'filesDataStorage': {
                        include_once 'lib/filesDataStorage/filesDataStorage.php';
                        $folder = PATH_APPLICATION . '/var/cache/';
                        $this->_cache = new \filesDataStorage\filesDataStorage ( $folder );
                        break;
                    }
                default : {
                        $this->_cache = false;
                        break;
                    }
            }
        }
        $this->time += \microtime ( true ) - $tmpTime;
        return null;
    }

    /**
     *
     * Сохраняет значение в кеше
     *
     * @param string $valueName
     * @param abstract $valueContent
     * @param int $periodMinutes
     */
    public function setValue ( $valueName, $valueContent, $periodMinutes ) {
        $result = false;
        $tmpTime = \microtime ( true );
        if ($this->_cache !== false) {
            $this->requests++;
            switch ($this->type) {
                case 'Memcached': {
                        $result = $this->_cache->set ( $this->prefix . $valueName, $valueContent, false, $periodMinutes * 60 );
                        break;
                    }
                case 'filesDataStorage': {
                        $queryFilter = new \filesDataStorage\QueryFilter();
                        $data['_id'] = '_cache';
                        $queryFilter->setData ( $data );
                        $data = $this->_cache->selectCollection ( '_filesds' )->get ( $queryFilter );
                        unset ( $queryFilter );
                        if (\is_array ( $data )) {
                            $data = $data[0];
                        } else {
                            $data['_id'] = '_cache';
                        }
                        $data[$valueName] = $valueContent;
                        $data['_fds_ttl' . $valueName] = $periodMinutes;
                        $data['_fds_crt' . $valueName] = time();
                        $result = $this->_cache->selectCollection ( '_filesds' )->save ( $data );
                        break;
                    }
            }
        }
        $this->time += \microtime ( true ) - $tmpTime;
        return $result;
    }

    /**
     *
     * Возвращает значение из кеша
     *
     * @param string $valueName
     */
    public function getValue ( $valueName ) {
        $result = false;
        $tmpTime = \microtime ( true );
        if ($this->_cache !== false) {
            $this->requests++;
            switch ($this->type) {
                case 'Memcached': {
                        $result = $this->_cache->get ( $this->prefix . $valueName );
                        break;
                    }
                case 'filesDataStorage': {
                        $queryFilter = new \filesDataStorage\QueryFilter();
                        $data['_id'] = '_cache';
                        $queryFilter->setData ( $data );
                        $tmpRes = $this->_cache->selectCollection ( '_filesds' )->get ( $queryFilter );
                        if (
                                isset ( $tmpRes[0][$valueName] )
                                && isset ( $tmpRes[0]['_fds_ttl' . $valueName] )
                                && isset ( $tmpRes[0]['_fds_crt' . $valueName] )
                                && (time() - ($tmpRes[0]['_fds_crt' . $valueName])) < ($tmpRes[0]['_fds_ttl' . $valueName] * 60)) {
                            $result = $tmpRes[0][$valueName];
                        }
                        break;
                    } //case fds
            } //switch
        } // cache enabled
        $this->time += \microtime ( true ) - $tmpTime;
        return $result;
    }

    public function getTime () {
        return $this->time;
    }

    public function getRequests () {
        return $this->requests;
    }

}
namespace phpMyEngine\l10n;

function _ ( $text, $domain = 'default' ) {
    $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $domain . '.mo', 'usr/locale/ru_RU/LC_MESSAGES' );
    $locDir = dirname ( dirname ( dirname ( $rp ) ) );
    \bindtextdomain ( $domain, $locDir );
    \bind_textdomain_codeset ( $domain, 'UTF-8' );
    return dgettext ( $domain, $text );
}