<?php
namespace phpMyEngine\logsController;

function defaultAction () {
    $_myStructure = \phpMyEngine\EngineFileSystem\Structure::getInstance ();
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( null, 'var/logs' )) {
        $odir = \getcwd();
        \chdir ( $rp );
        $logs = \glob ( '*.log' );
        \chdir ( $odir );
        for ($i = 0, $ca = count ( $logs ); $i < $ca; $i++) {
            $logs[$i] = \substr (
                            \substr ( $logs[$i], 0, 2 ) . '.' .
                            \substr ( $logs[$i], 2, 2 ) . '.' .
                            \substr ( $logs[$i], 4 )
                            , 0, -4 );
        }
        $_myRender->setValue ( 'logsList', $logs );
        $_myRender->renderTemplate ( 'logs/list.tpl' );
    }
    return null;
}

function viewAction () {
    $_myRoute = \phpMyEngine\Route::getInstance();
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $fname = \str_replace ( '.', null, $_myRoute->log ) . '.log';
    if (false !== $rp = \phpMyEngine\EngineFileSystem\getRealFilePath ( $fname, 'var/logs' )) {
        $logContent = \explode(PHP_EOL,\file_get_contents ( $rp));
        for ($i = 0, $ca = count($logContent); $i < $ca; $i++) {
            $logContent[$i] = \explode("\t", $logContent[$i]);
        }
        $_myRender->setValue ( 'logDate', $_myRoute->log );
        $_myRender->setValue ( 'logContent', $logContent );
        $_myRender->renderTemplate ( 'logs/log.tpl' );
    }
}