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
const DEBUG = true;

if (DEBUG == true) {
    define ( "DEBUG_START_TIME", microtime ( true ) );
}

define ( 'PATH_APPLICATION', dirname ( __DIR__ ) . '/phpmyengine' );

set_include_path ( get_include_path() . ':' . PATH_APPLICATION );

putenv ( "LC_ALL=ru_RU" );
putenv ( "LANG=ru_RU" );
putenv ( "LANGUAGE=ru_RU" );
setlocale ( LC_ALL, 'ru_RU.utf8' );
/*
  \bindtextdomain ( 'default', PATH_APPLICATION . '/usr/locale/' );
  \textdomain ( "default" ); */

include 'lib/engine.lib.php';
include 'lib/records.lib.php';

/* function autoload ( $name ) {
  if (\substr ( $name, 0, 12 ) == 'phpMyEngine\\') {
  $fname = PATH_APPLICATION . '/' . strtolower ( substr ( $name, strrpos ( $name, '\\' ) + 1 ) ) . '.lib.php';
  echo $fname;
  if (\file_exists ( $fname )) {

  include_once $fname;
  }
  }
  }

  spl_autoload_register ( __NAMESPACE__ . '\autoload' );
 */
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
$_myRender->setTitle ( $_myConfig->engine->siteName, $_myRender::TITLE_APPEND );

$_myRender->getOutput ();
\ob_end_clean();

if (DEBUG == true) {
    $dbPorfile = $_myConfig->engine->databaseProfile;
    $dbInfo = \phpMyEngine\Database\Storage::getInstance();
    $_debugInfo = array (
        'genTime' => round ( microtime ( true ) - DEBUG_START_TIME, 4 ),
        'memory' => \memory_get_usage ( true ) / 1024,
        'includedFiles' => count ( \get_included_files () ),
        'HTML' => $_myRender->htmlsize,
        'dbProfile' => $dbPorfile,
        'dbType' => $_myConfig->$dbPorfile->type,
        'dbSuccessQueries' => $dbInfo->countQueries,
        'dbErrorQueries' => $dbInfo->countErrorQueries,
        'dbTime' => round ( $dbInfo->time, 4 )
    );
    $_myRender->setValue ( '_debugInfo', $_debugInfo );
    $_myRender->applyDebugInfo ( $_myRender->renderTemplate ( '__debug.tpl', true ) );
}
$_myRender->show ();