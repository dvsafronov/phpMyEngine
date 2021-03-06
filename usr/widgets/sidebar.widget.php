<?php

/**
 * phpMyEngine sidebar widget
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2011 
 * @version 2010-04-01 18:46
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 */
namespace phpMyEngine\Widgets;

function sidebarWidget () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myCache = \phpMyEngine\Cache\Cache::getInstance ();
    if (false === ($filesList = $_myCache->getValue ( '__sidebarWidgetsFilesList' ))) {
        $filesList = \phpMyEngine\EngineFileSystem\getFilesList ( 'usr/widgets/sidebar',
                '*.sidebar.widget.php' );
        $_myCache->setValue ( '__sidebarWidgetsFilesList', $filesList, 10 );
    }
    if (false !== $filesList && ($ca = count ( $filesList )) > 0) {
        $sidebar = array ();
        for ($i = 0; $i < $ca; $i++) {
            $sidebar[$i]['priority'] = (int) include_once $filesList[$i];
            $sidebar[$i]['fnc'] = 'phpMyEngine\Widgets\\' . \str_replace ( '.sidebar.widget.php',
                            null,
                            substr ( $filesList[$i],
                                    strrpos ( $filesList[$i], '/' ) + 1 ) ) . 'Widget';
        }
        rsort ( $sidebar );
        \array_walk ( $sidebar,
                function ($item, $key) {
                    $item['fnc'] ();
                    return null;
                } );
        unset ( $sidebar );
    }
    return null;
}
