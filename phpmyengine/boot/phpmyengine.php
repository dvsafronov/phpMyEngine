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

const VERSION = '0.0.1-dev';

define ( 'PATH_APPLICATION', dirname ( __DIR__ ) );


set_include_path ( get_include_path() . ':' . PATH_APPLICATION );

if (\defined ( '\phpMyEngine\DEBUG' ) && \phpMyEngine\DEBUG == true) {
    define ( "DEBUG_START_TIME", microtime ( true ) );
}

putenv ( "LC_ALL=ru_RU" );
putenv ( "LANG=ru_RU" );
putenv ( "LANGUAGE=ru_RU" );
setlocale ( LC_ALL, 'ru_RU.utf8' );

include 'lib/engine.lib.php';
include 'lib/records.lib.php';

\ob_start();
$_myConfig = \phpMyEngine\Config\Config::getInstance ();
$_myRender = \phpMyEngine\Render\Render::getInstance ();

\phpMyEngine\EngineFileSystem\Structure::getInstance();
\phpMyEngine\Route::getInstance();
//TODO: Либо сделать, чтобо оно работало, либо проверить что оно работает, либо прибить нах
if ($_myRender->monopolyView !== true) {
    if (isset ( $_myConfig->view->skin )) {
        $_myRender->setValue ( '__skin', $_myConfig->view->skin );
    }
    $_myRender->renderTemplate ( '__' . $_myConfig->engine->design . '.tpl' );
} else {
    \phpMyEngine\runController();
}
$_myRender->setTitle ( $_myConfig->engine->siteName, $_myRender::TITLE_APPEND );

$_myRender->getOutput ();
\ob_end_clean();

if (\phpMyEngine\DEBUG == true) {
    $dbPorfile = $_myConfig->engine->databaseProfile;
    $cacheProfile = $_myConfig->engine->cacheProfile;
    $dbInfo = \phpMyEngine\Database\Storage::getInstance();
    $_debugInfo = array (
        'genTime' => round ( microtime ( true ) - DEBUG_START_TIME, 4 ),
        'memory' => \memory_get_usage ( true ) / 1024,
        'includedFiles' => count ( \get_included_files () ),
        'HTML' => isset ( $_myRender->htmlsize ) ? $_myRender->htmlsize : 0,
        'dbProfile' => $dbPorfile,
        'dbType' => $_myConfig->$dbPorfile->type,
        'dbSuccessQueries' => $dbInfo->countQueries,
        'dbErrorQueries' => $dbInfo->countErrorQueries,
        'dbTime' => round ( $dbInfo->time, 4 ),
        'cacheEnabled' => $_myConfig->engine->cache,
        'cacheProfile' => $cacheProfile,
        'cacheType' => $_myConfig->$cacheProfile->type,
        'cacheRequests' => \phpMyEngine\Cache\Cache::getInstance()->getRequests (),
        'cacheTime' => round ( \phpMyEngine\Cache\Cache::getInstance()->getTime (), 4 )
    );
    $_myRender->setValue ( '_debugInfo', $_debugInfo );
    $_myRender->applyDebugInfo ( $_myRender->renderTemplate ( '__debug.tpl', true ) );
}
$_myRender->show ();