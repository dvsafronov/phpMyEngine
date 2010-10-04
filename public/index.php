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
// debug status, turn false on production server
const DEBUG = false;

define('PATH_APPLICATION',dirname ( __DIR__).'/phpmyengine');

set_include_path ( get_include_path() . ':' . PATH_APPLICATION );

setlocale ( LC_ALL, 'ru_RU.UTF-8' );
if (DEBUG == true) {
    define ( "DEBUG_START_TIME", microtime ( true ) );
}

include 'lib/engine.lib.php';
include 'lib/records.lib.php';
include 'lib/persons.lib.php';

\ob_start();
$_myConfig = \phpMyEngine\Config\Config::getInstance ();
$_myRender = \phpMyEngine\Render\Render::getInstance ();

\phpMyEngine\EngineFileSystem\Structure::getInstance();
\phpMyEngine\Route::getInstance();

if ($_myRender->monopolyView !== true) {
    $_myRender->Smarty ()->display ( '__' . $_myConfig->engine->design . '.tpl' );
} else {
    \phpMyEngine\runController();
}
$_myRender->setTitle($_myConfig->engine->siteName,$_myRender::TITLE_APPEND);

$_myRender->getOutput ();
\ob_end_clean();
if (DEBUG == true) {
    $_debugInfo = 'Время генерации: ' . round ( microtime ( true ) - DEBUG_START_TIME, 4 ) . ' сек <br />';
    $_debugInfo .= 'Использовано памяти: ' . (\memory_get_usage ( true ) / 1024) . 'Кб <br />';
    $_debugInfo .= 'Вложено файлов: ' . count ( \get_included_files () ) . '<br />';
    $dbInfo = \phpMyEngine\Database\Storage::getInstance();
    $_debugInfo .= 'БД: <br />';
    $_debugInfo .= '&nbsp;&nbsp;&nbsp;&nbsp;Запросов: ' . $dbInfo->countQueries . ' / ' . $dbInfo->countErrorQueries . '<br />';
    $_debugInfo .= '&nbsp;&nbsp;&nbsp;&nbsp;Время: ' . round ( $dbInfo->time, 4 ) . ' сек <br />';
    $_myRender->applyDebugInfo ( $_debugInfo );
}
$_myRender->show ();