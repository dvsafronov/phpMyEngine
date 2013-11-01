<?php

/**
 * phpMyEngine
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 0.0.1-dev
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */

namespace phpMyEngine;

const VERSION = '0.0.2-dev';

if (strpos(PHP_VERSION, 'hiphop')) {
    define('HHVM_SERVER', true);
}

define('PATH_APPLICATION', dirname(__DIR__));

set_include_path(get_include_path().':'.PATH_APPLICATION);

if (\defined('\phpMyEngine\PME_DEBUG') && \phpMyEngine\PME_DEBUG == true) {
    define("DEBUG_START_TIME", microtime(true));
}

include_once 'lib/engine.lib.php';
include_once 'lib/config.lib.php';
include_once 'lib/cache.lib.php';
include_once 'lib/database.lib.php';
include_once 'lib/render.lib.php';
include_once 'lib/render_mods.lib.php';
include_once 'lib/template.lib.php';
include_once 'lib/pictures.lib.php';

include_once 'lib/system_city.lib.php';
include_once 'lib/records.lib.php';
\ob_start();
$_myConfig = \phpMyEngine\Config\Config::getInstance();
$_myRender = \phpMyEngine\Render\Render::getInstance();

\phpMyEngine\EngineFileSystem\Structure::getInstance();

$_myRoute = \phpMyEngine\Route::getInstance();
if ($_myRoute->controller == false) {
    $_myRoute->controller = $_myConfig->engine->defaultController;
}

$_myRender->monopolyView = (bool) \phpMyEngine\EngineFileSystem\getRealFilePath((string) $_myRoute->controller,
        'etc/monopolyview') || $_myRoute->isAJAX();

if ($_myRender->monopolyView !== true) {
    if (isset($_myConfig->view->skin)) {
        $_myRender->setValue('__skin', $_myConfig->view->skin);
    }
    $_myRender->renderTemplate('__'.$_myConfig->engine->design.'.tpl');
} else {
    \phpMyEngine\runController();
}
$_myRender->setTitle($_myConfig->engine->siteName, $_myRender::TITLE_APPEND);

$_myRender->getOutput();
\ob_end_clean();

if (\phpMyEngine\PME_DEBUG == true) {
    $dbProfile = $_myConfig->engine->databaseProfile;
    $cacheProfile = $_myConfig->engine->cacheProfile;
    $_debugInfo = array(
        'genTime' => round(microtime(true) - DEBUG_START_TIME, 4),
        'memory' => \memory_get_usage(true) / 1024,
        'includedFiles' => count(\get_included_files()),
        'HTML' => isset($_myRender->htmlsize) ? $_myRender->htmlsize : 0,
        'dbStat' => \phpMyEngine\Database\Statistic::getInstance(),
        'cacheEnabled' => $_myConfig->engine->cache,
        'cacheProfile' => $cacheProfile,
        'cacheType' => $_myConfig->$cacheProfile->type,
        'cacheRequests' => \phpMyEngine\Cache\Cache::getInstance()->getRequests(),
        'cacheTime' => round(\phpMyEngine\Cache\Cache::getInstance()->getTime(), 4)
    );
    $_myRender->setValue('_debugInfo', $_debugInfo);
    $_myRender->applyDebugInfo($_myRender->renderTemplate('__debug.tpl', true));
}
$_myRender->show();