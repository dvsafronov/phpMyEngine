<?php

/**
 *
 * Библиотека основных функций и классов phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010-2011
 * @version 2011-04-01 18:38
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */

namespace phpMyEngine;

use phpMyEngine\Render\Render;

class NullStorage {
    public function __get($name) {
        return null;
    }
}

class Exception extends \Exception {

    const TYPE_ERROR = 1;
    const TYPE_WARNING = 2;
    const TYPE_HINT = 3;

    public $caErrors, $caWarnings, $caHints, $text;

    public function __construct($type = null, $message = null) {
        if (null !== $type && null !== $message) {
            switch ($type) {
                case self::TYPE_ERROR :
                {
                    $this->caErrors++;
                    break;
                }
                case self::TYPE_WARNING :
                {
                    $this->caWarnings++;
                    break;
                }
                case self::TYPE_HINT :
                {
                    $this->caHints++;
                    break;
                }
                default:
                    {
                    break;
                    }
            }
            $this->text = $message;
        }
        return null;
    }

}

class Messages {

    public $errors = array();
    public $messages = array();
    public $warnings = array();
    public $caErrors, $caWarnings, $caMessages;

    public function addError($text) {
        array_push($this->errors, $text);
        $this->caErrors = $this->caErrors + 1;
    }

    public function addMessage($text) {
        array_push($this->messages, $text);
        $this->caMessages = $this->caMessages + 1;
    }

    public function addWarning($text) {
        array_push($this->warnings, $text);
        $this->caWarnings = $this->caWarnings + 1;
    }

    public function export() {

    }

}

function logError($desc, $hold = false) {
    $e = date('H:i:s')."\t".(isHHVM() ? $_SERVER['HTTP_REQUEST_URI'] : $_SERVER['REQUEST_URI'])."\t".$_SERVER ['REMOTE_ADDR']."\t".$desc.PHP_EOL;
    file_put_contents(PME_SITE_DIR.'/var/logs/'.date('Ymd').'.log', $e, FILE_APPEND);
    if ($hold == true) {
        if (PME_DEBUG != 1) {
            $desc = "Check Engine";
        }
        echo $desc;
        die();
    }
}

function doRedirect($url) {
    Header('HTTP/1.1 301 Moved Permanently', true);
    header('Location: '.$url, true);
    die();
}

function throwErrorPage404() {
    header('HTTP/1.1 404 Not Found', true);
    Render::getInstance()->renderTemplate('errors/404.tpl', false, true);
    die();
}

function loadModule($name) {
    if (false !== $rp = EngineFileSystem\getRealFilePath($name.'.lib.php', 'usr/lib')) {
        include_once $rp;
    }
    return null;
}

function getCreationTimeByID($_id, $format = 'd.m.Y H:i:s') {
    /*
     *
     * 10485.76 - это очень магическая цифра, менять её нельзя
     * Именно благодаря ей, волшебству и парням с улиц, идентификатор
     * записи превращяется во время, когда этот идентификатор был установлен
     * Магия, ёпт.
     *
     */
    return date($format, ((int) substr(substr($_id, 0, -2) / 10485.76, 0, -4)));
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
function isAJAXRequest() {
    if (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER)) {
        return $_SERVER ['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    }
    return false;
}

/**
 * Проверяет, запущен ли phpMyEngine через сервер HipHop Virtual Machine
 *
 * @return bool
 */

function isHHVM() {
    return defined('HHVM_SERVER') && HHVM_SERVER === true;
}

/**
 * Проверяет, существует ли функция
 *
 * NOTE: Так как в HHVM (на момент написания этой функции) существует фича,
 * из-за которой, не проверяется существование функции в неймспейсе, если
 * строка начинается с "\", но при этом, в "нормальном" PHP всё наоброрт,
 * пришлось написать этот враппер.
 *
 * @param $funcName
 */

function functionExists($funcName) {
    return function_exists(substr($funcName, 0, 1) == '\\'
            ? substr($funcName, 1)
            : $funcName
    );
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
function runController() {
    $_myConfig = Config\Config::getInstance();
    $_myRoute = Route::getInstance();
    if ($_myRoute->controller === false) {
        $_myRoute->controller = $_myConfig->engine->defaultController;
    }
    $path = $_myRoute->isControlPanel() ? 'sbin' : 'bin';
    if (false === $rp = \phpMyEngine\EngineFileSystem\getRealFilePath($_myRoute->controller.'.php', 'usr/'.$path)) {
        \phpMyEngine\throwErrorPage404();
    }
    include_once $rp;
    $func = '\phpMyEngine\\'.$_myRoute->controller.'Controller\\'.$_myRoute->action.'Action';
    if (functionExists($func)) {
        $func();
    } else {
        $func = '\phpMyEngine\\'.$_myRoute->controller.'Controller\\'.'defaultAction';
        if (functionExists($func)) {
            $func();
        } else {
            echo $func;
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
    private $_isAJAX = false;
    private $_data = [];

    public function __set($name, $value) {
        return $this->_data[$name] = $value;
    }

    public function __get($name) {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }
        return null;
    }

    public function isControlPanel() {
        return $this->_controlpanel;
    }

    public function isAJAX() {
        return $this->_isAJAX;
    }

    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->parseRequest();
        return null;
    }

    /**
     * Парсинг запроса, поиск нужного контроллера, заполнение данных маршрута
     * @return NULL
     */
    private function parseRequest() {
        $_myConfig = \phpMyEngine\Config\Config::getInstance();
        $_myCache = \phpMyEngine\Cache\Cache::getInstance();

        $separator = '/';
        $request = \urldecode((isHHVM() ? $_SERVER['HTTP_REQUEST_URI'] : $_SERVER['REQUEST_URI']));
        if (isset($_myConfig->controlPanel->host)) {
            if ($_SERVER['HTTP_HOST'] == $_myConfig->controlPanel->host) {
                $_myConfig->controlPanel->URI = 'http://'.$_SERVER['HTTP_HOST'];
                $this->_controlpanel = true;
            }
        } elseif (isset($_myConfig->controlPanel->virtualController)) {
            $_vcp = $_myConfig->controlPanel->virtualController;
            if (\substr($request, 0, strlen($_vcp) + 2) == '/'.$_vcp.'/') {
                $request = \substr($request, strlen($_vcp) + 1);
                $this->_controlpanel = true;
                $_myConfig->controlPanel->URI = '/'.$_vcp;
                unset($_vcp);
            }
        }

        if (substr($request, -6) == '::ajax') {
            if (\phpMyEngine\isAJAXRequest()) {
                $this->_isAJAX = true;
            } else {
                $request = substr($request, 0, -6);
                doRedirect($request);
            }
        }

        if ($this->_controlpanel == true) {
            Render::getInstance()->setDesign('cp');
            $mySt = \phpMyEngine\EngineFileSystem\Structure::getInstance();
            if (\phpMyEngine\ControlPanel\isAuth() === false && $this->controller != 'cpauth') {
                if ($this->_isAJAX) {
                    Header('HTTP/1.1 403 Forbidden', true);
                    echo json_encode(['status' => 1, 'content' => 'not authorized']);
                    die();
                }
                $this->controller = 'cpauth';
                $this->action = null;
                return null;
            }
        }

        // всё, что до первого сепаратора - есть имя контроллера
        $this->controller = substr($request, 1);
        if (strpos($this->controller, $separator)) {
            $this->controller = \substr($this->controller, 0, strpos($this->controller, $separator));
        }
        // всё, что после последнего сепоратора - есть страницы номер.
        // если явно указано page - его трём и оставляем цифрки, всё остальное - нуль
        if (substr($request, strrpos($request, $separator) + 1, 4) == 'page') {
            $this->page = (int) str_replace('page', null, substr($request, strrpos($request, $separator, 1) + 1));
        }
        // убираем уже известные нам данные
        $request = substr($request, strlen($this->controller) + 2);
        if (substr($request, \strlen($request) - 1) == $separator) {
            $request = \substr($request, 0, -1);
        }
        // подгружаем паттерны
        if (false === ($patterns = $_myCache->getValue("__route_{$this->controller}"))) {
            if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath($this->controller.'.route.php', 'etc/routerrules')) {
                $patterns = include($rp);
                $_myCache->setValue("__route_{$this->controller}", $patterns, 12);
            }
        }
        // производим проверку на соответствие паттернам
        if (is_array($patterns)) {
            $matches = null;
            foreach ($patterns as $rule) {
                if (preg_match($rule['pcre'], $request, $matches)) {
                    for ($i = 1, $ca = count($matches); $i < $ca; $i++) {
                        $matches [$i] = str_replace(';', '\U+003B', $matches [$i]);
                        $rule['result'] = str_replace('$'.$i, $matches [$i], $rule['result']);
                    }
                    $rule['result'] = explode(';', $rule['result']);
                    for ($i = 0, $ca = count($rule['result']); $i < $ca; $i++) {
                        $tmp = explode('=', $rule['result'] [$i]);
                        $this->$tmp [0] = str_replace('\U+003B', ';', $tmp [1]);
                    }
                    unset($rule['result'], $matches, $tmp, $ca);
                    break;
                }
            }
        }
        unset($patterns, $separator, $request);
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
    private $structure = [];

    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self ();
        }
        return self::$instance->structure;
    }

    private function __construct() {
        $_myCache = \phpMyEngine\Cache\Cache::getInstance();
        if (false === ($this->structure = $_myCache->getValue('__mystructure'))) {
            $this->structure = is_array($this->structure) ? $this->structure : [];
            $this->getFilesList(\phpMyEngine\PME_CORE_DIR, $this->structure);
            $this->getFilesList(\phpMyEngine\PME_SITE_DIR, $this->structure);
            $_myCache->setValue('__mystructure', $this->structure, 10);
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
     * @param array $output
     * @param string $initialPath
     * @return null
     */

    private function getFilesList($path, Array &$output, $initialPath = '') {
        $initialPath = $initialPath ? : $path;
        $iterator = new \RecursiveDirectoryIterator($path);
        while ($iterator->valid()) {
            if (false === $iterator->isDot()) {
                if ($iterator->isDir()) {
                    $func = __FUNCTION__;
                    self::$func($iterator->key(), $output, $initialPath);
                    $key = \str_replace($initialPath.'/', null, $iterator->getFileInfo());
                    if (substr($key, 0, 4) == 'opt/') {
                        $key = substr($key, \strpos($key, '/', 4) + 1);
                    }
                    if ($iterator->getPath() != $initialPath.'/opt' && $key != 'opt') {
                        $output[$key][] = $iterator->key();
                    }
                }
            }
            $iterator->next();
        }
        return null;
    }

}

/**
 *
 * Производит проверку на существование файла по его виртуальному пути
 *
 * @param string $file
 * @param string $path
 * @param bool $all
 *
 * @return array|bool|string
 *
 * @author Denis xmcdbx Safonov
 * @version 2010-09-11 15:58
 *
 */

function getRealFilePath($file, $path, $all = false) {
    $_myStructure = Structure::getInstance();
    if (\array_key_exists($path, $_myStructure)) {
        if (false !== $all) {
            $result = array();
        }
        for ($i = 0, $ca = count($_myStructure[$path]); $i < $ca; $i++) {
            if (\file_exists($_myStructure [$path][$i].'/'.$file)) {
                if (false === $all) {
                    return $_myStructure [$path][$i].'/'.$file;
                } else {
                    \array_push($result, $_myStructure [$path][$i].'/'.$file);
                }
            }
        }
        if (false !== $all && count($result) > 0) {
            return $result;
        }
    }
    return false;
}

function getFilesList($path, $mask = '*') {
    $_myStrucutre = Structure::getInstance();
    if (false !== ($rpList = getRealFilePath('', $path, true)) && ($ca = count($rpList)) > 0) {
        $files = array();
        $oDir = getcwd();
        $stickPath = function (&$item, $null, $fullPath) {
            $item = $fullPath.$item;
        };
        for ($i = 0; $i < $ca; $i++) {
            chdir($rpList[$i]);
            $list = glob($mask);
            \array_walk($list, $stickPath, $rpList[$i]);
            $files = \array_merge($files, $list);
            unset($list);
        }
        chdir($oDir);
        return $files;
    }


    return null;
}

namespace phpMyEngine\ControlPanel;

use phpMyEngine\Config\Config;

function isAuth() {
    if (!session_id()) {
        session_start();
    }
    return
        isset($_SESSION['_cplogin'])
        && isset($_SESSION['_cppasshash'])
        && $_SESSION['_cplogin'] == Config::getInstance()->controlPanel->login
        && $_SESSION['_cppasshash'] == sha1(Config::getInstance()->controlPanel->password);
}

function doQuit() {
    return $_SESSION['_cplogin'] = $_SESSION['_cppasshash'] = null;
}

function doAuth($login, $password) {
    $_referenceAuth[] = Config::getInstance()->controlPanel->login;
    $_referenceAuth[] = sha1(Config::getInstance()->controlPanel->password);
    // have a nice day ;)
    if ((bool) ((int) array_diff(array($login, sha1($password)), $_referenceAuth) - 1)) {
        if (!session_id()) {
            session_start();
        }
        $_SESSION['_cplogin'] = $login;
        $_SESSION['_cppasshash'] = sha1($password);
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

    public function __construct($formTag = null) {
        if (is_object($formTag)) {
            foreach ($formTag as $key => $value) {
                $this->$key = $value;
            }
        }
        return null;
    }

    public function __toString() {
        if (in_array($this->type, array('text', 'checkbox', 'radio', 'select', 'textarea', 'hidden'))) {
            $strID = $strType = $strName = $strValue = $strMaxLength =
            $strSelected = $strReadonly = $strDisabled = $strMultiple = null;
            if (strlen($this->id) > 0) {
                $strID = ' id="'.$this->id.'" ';
            }
            if (strlen($this->name) > 0) {
                $strName = ' name="'.$this->name.'" ';
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
                    $strMaxLength = ' maxlength="'.(int) $this->maxLength.'" ';
                }
            }
            if ($this->type == 'textarea') {
                if ((int) $this->rows > 0) {
                    $strMaxLength = ' rows="'.(int) $this->rows.'" ';
                }
                $strValue = '>'.$this->value.'</textarea';
            }
            if ($this->type == 'select') {
                if ($this->multiple == true) {
                    $strMultiple = ' multiple';
                }
                if (isset($this->options) && \is_string($this->options) &&
                    preg_match('/^\$\((.*)\)$/i', (string) $this->options, $matches)
                ) {
                    $callFunc = '\phpMyEngine\Modules\\'.\str_replace('/', '\\', $matches[1]);
                    if (\phpMyEngine\functionExists($callFunc)) {
                        $this->options = $callFunc();
                    } else {
                        \phpMyEngine\logError($callFunc." doesn't exists!");
                        $this->options = null;
                    }
                }
                $strOptions = null;
                if (isset($this->options) && is_array($this->options) === false) {
                    $this->options = null;
                } else {
                    foreach ($this->options as $key => $value) {
                        $selected = $value == $this->value ? ' selected="selected" ' : '';
                        $strOptions .= '<option value="'.$value.'"'.$selected.'>'.$key.'</option>'.PHP_EOL;
                    }
                }

                $strValue = '>'.$strOptions.'</select';
            }
            if ($strValue == null) {
                $strValue = ' value="'.$this->value.'" ';
            }
            if ($this->type == 'text' || $this->type == 'radio' || $this->type == 'checkbox') {
                $strType = 'input type="'.$this->type.'" ';
            } else {
                $strType = $this->type;
            }
            if ($this->type == 'hidden') {
                $strType = 'input type="hidden" ';
            }
            $formElement = '<'.$strType.$strID.$strName.$strReadonly.$strMaxLength.
                $strDisabled.$strMultiple.$strValue.'>';
            return $formElement;
        } else {
            /* код ниже ничего не делает */
            $_myStructure = \phpMyEngine\EngineFileSystem\Structure::getInstance();
            if (\phpMyEngine\EngineFileSystem\getRealFilePath('etc/formelements/'.\strtolower($this->type).'.tpl', '')) {
                \ob_start();
                if (isset($this->options) && \is_string($this->options) &&
                    preg_match('/^_\((.*)\)$/i', (string) $this->options, $matches)
                ) {
                    $callFunc = '\phpMyEngine\\'.\str_replace('/', '\\', $matches[1]);
                    if (\phpMyEngine\functionExists($callFunc)) {
                        $this->options = $callFunc();
                    } else {
                        \phpMyEgine\logError($callFunc." doesn't exists!");
                        $this->options = null;
                    }
                }
                if (isset($this->options) && is_array($this->options) === false) {
                    $this->options = null;
                }
                $formElement = \ob_get_contents();
                \ob_end_clean();
                return $formElement;
            }
            \phpMyEngine\logError("Unknow tag - {$this->type}!");
            return 'Unknow tag';
        }
    }

}

namespace phpMyEngine\l10n;

function _($text, $domain = 'default') {
    $rp = \phpMyEngine\EngineFileSystem\getRealFilePath($domain.'.mo', 'usr/locale/ru_RU/LC_MESSAGES');
    $locDir = dirname(dirname(dirname($rp)));
    \bindtextdomain($domain, $locDir);
    \bind_textdomain_codeset($domain, 'UTF-8');
    return dgettext($domain, $text);
}

namespace phpMyEngine\Widgets;

function getWidgetPriority($config, $widget) {
    $_myConfig = \phpMyEngine\Config\Config::getInstance()->load($config, true);

    return isset($_myConfig->widgetPriorty->$widget) ? $_myConfig->widgetPriorty->$widget : 1;
}

namespace phpMyEngine\AJAX;

const AJAX_STATUS_OK = 1;
const AJAX_STATUS_ERROR = 0;

class Response {
    private $_data = [];

    public function setStatus($status) {
        $this->_data['status'] = (int) $status;
    }

    public function setContent($content) {
        $this->_data['content'] = $content;
    }

    public function __toString() {
        $res = json_encode($this->_data);
        unset($this);
        return $res;
    }

    public function output() {
        echo $this;
    }
}