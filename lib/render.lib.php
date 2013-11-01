<?php

namespace phpMyEngine\Render;

function resetOutput() {
    ob_end_clean();
    return null;
}

class Breadcrumb {
    public $href;
    public $title;
    public $active;

    public function __construct($href, $title, $active = false) {
        $this->href = $href;
        $this->title = $title;
        $this->active = $active;
    }
}

class Render {
    const TITLE_PREPEND = 1;
    const TITLE_APPEND = 2;
    const TITLE_REPLACE = 0;
    private $_data;
    private $_breadcrumbs = [];
    private $_design;
    private $_css = [];
    private $content, $situation, $title;
    public $monopolyView, $module, $rssLink;
    protected static $instance; // object instance

    public static function &getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        if (\ob_get_status() == false) {
            \ob_start();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->_design = \phpMyEngine\Config\Config::getInstance()->engine->design;
        return null;
    }

    public function setDesign($design) {
        $this->_design = $design;
        return null;
    }

    public function getOutput() {
        $this->content = \ob_get_clean();
        if (\defined('phpMyEngine\DEBUG') && \phpMyEngine\PME_DEBUG == true) {
            $this->htmlsize = strlen($this->content);
        }
        return null;
    }

    public function renderTemplate($name, $toVar = false, $monopoly = false) {
        try {
            if ($toVar === true) {
                \ob_start();
            }
            if ($monopoly === true) {
                \ob_get_clean();
                \ob_start();
            }
            $this->insertTpl($name);
            if ($monopoly === true) {
                die();
            }
            if ($toVar === true) {
                return \ob_get_clean();
            }
        } catch (\Exception $e) {
            $file = \str_replace(dirname(__DIR__).'/', null, $e->getFile());
            \phpMyEngine\logError($e->getMessage().' ('.$file.')');
        }
        return null;
    }

    public function setValue($valName, $valContent) {
        $this->_data[$valName] = $valContent;
    }

    private function prepareContent() {
        $this->content = \str_replace('<title></title>', "<title>{$this->title}</title>", $this->content);
        $this->applyBreadcrumbs();
        $this->applyCSS();
        return null;
    }

    public function show() {
        $this->prepareContent();
        echo $this->content;
    }

    public function setTitle($text, $replacmentType = self::TITLE_REPLACE) {
        switch ($replacmentType) {
            case self::TITLE_REPLACE:
            {
                $this->title = $text;
                break;
            }
            case self::TITLE_APPEND:
            {
                if (strlen($this->title) > 0) {
                    $this->title = $this->title." / ";
                }
                $this->title .= $text;
                break;
            }
            case self::TITLE_PREPEND:
            {
                $this->title = $text." / ".$this->title;
                break;
            }
        }
    }

    public function applyDebugInfo($text) {
        $this->content = \str_replace('<!--phpMyEngine::debugInfo/-->', $text, $this->content);
    }

    public function addCSS($file) {
        \array_push($this->_css, $file);
        return null;
    }

    public function insertTpl($name, $params = null) {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath($name, "usr/tpl/{$this->_design}")) {
            if ($params !== null && is_array($params)) {
                foreach ($params as $key => $value) {
                    $this->setValue($key, $value);
                }
            }
            include $rp;
        }
        return null;
    }

    public function insertWidget($name, $params = null) {
        if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath($name.'.widget.php', 'usr/widgets')) {
            include_once $rp;
            $func = '\phpMyEngine\Widgets\\'.$name.'Widget';
            return $func($params);
        }
        return null;
    }

    public function getValue($param, $applyMods = null) {
        if (isset($this->_data[$param])) {
            if (strlen($applyMods) > 0) {
                $this->applyMods($applyMods, $this->_data[$param]);
            }
            return $this->_data[$param];
        }
        return null;
    }

    public function applyMods($mods, $data) {
        $mods = explode(',', $mods);
        if (count($mods) > 0) {
            foreach ($mods as $func) {
                $func = '\phpMyEngine\Render\Mods\\'.$func.'Mod';
                if (\phpMyEngine\functionExists($func)) {
                    $data = $func($data);
                }
            }
        }
        return $data;
    }

    public function addBreadcrumb($href, $title, $active = false) {
        return array_push($this->_breadcrumbs, new Breadcrumb($href, $title, $active));
    }

    public function getBreadcrumbs() {
        return $this->_breadcrumbs;
    }

    public function applyBreadcrumbs() {
        $breadcrumbs = self::renderTemplate('widgets/breadcrumb/breadcrumbs.phtml', true);
        $this->content = \str_replace('<!--phpMyEngine::breadcrumbs/-->', $breadcrumbs, $this->content);
    }

    private function repairURLs($input, $iteration, $domain) {
        if (\preg_match_all('/url\((\'|")*([a-z0-9\:\.\/\-\_\ ]+)(\'|")*\)/i', $input, $mat)) {
            $newURLs = array();
            for ($i = 0, $ca = count($mat[2]); $i < $ca; $i++) {
                $lastPos = \strrpos($mat[2][$i], './');
                if ($lastPos != 0) {
                    $lastPos++;
                }
                $newURLs[] = \str_replace($_SERVER['DOCUMENT_ROOT'], null, realpath(substr($domain.$this->_css[$iteration], 0, strrpos($domain.$this->_css[$iteration], '/')).'/'.$mat[2][$i])
                );
            }
            $input = \str_replace($mat[2], $newURLs, $input);
            unset($newURLs, $lastPos, $mat);
        }
        return $input;
    }

    private function applyCSS() {
        $cssContent = null;
        $_myCSSConfig = \phpMyEngine\Config\Config::getInstance()->view->css;
        if (isset($_myCSSConfig->includeInDocument) && $_myCSSConfig->includeInDocument == true) {
            $cssContent = '<style type="text/css" />'.PHP_EOL;
            for ($i = 0, $ca = count($this->_css); $i < $ca; $i++) {
                $domain = null;
                if (\strpos($this->_css[$i], ':') == false) {
                    $domain = $_SERVER['DOCUMENT_ROOT'];
                }
                $cssContent .= $this->repairURLs(\file_get_contents($domain.$this->_css[$i]), $i, $domain);
            }
            $cssContent .= PHP_EOL."</style>";
        } else {
            if (isset($_myCSSConfig->uniteFiles) && $_myCSSConfig->uniteFiles == true) {
                $cssFileContent = null;
                $cssFile = "/shared/phpmyengine_".sha1(implode(null, \array_values($this->_css))).".css";
                if (false === \file_exists($_SERVER['DOCUMENT_ROOT'].$cssFile)) {
                    for ($i = 0, $ca = count($this->_css); $i < $ca; $i++) {
                        $domain = null;
                        if (\strpos($this->_css[$i], ':') == false) {
                            $domain = $_SERVER['DOCUMENT_ROOT'];
                        }
                        $cssFileContent .= $this->repairURLs(\file_get_contents($domain.$this->_css[$i]), $i, $domain);
                    }
                    \file_put_contents($_SERVER['DOCUMENT_ROOT'].$cssFile, $cssFileContent);
                }
                $cssContent .= '<link rel="stylesheet" type="text/css" href="'.'//'.$_SERVER['HTTP_HOST'].$cssFile.'" />'.\PHP_EOL;
            } else {
                for ($i = 0, $ca = count($this->_css); $i < $ca; $i++) {
                    $cssContent .= '<link rel="stylesheet" type="text/css" href="'.$this->_css[$i].'" />'.\PHP_EOL;
                }
            }
        }
        $this->content = \str_replace('</head>', "{$cssContent}\r\n</head>", $this->content);
    }

}