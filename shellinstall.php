<?php

/**
 * phpMyEngine shell installer
 *
 * @package phpMyEngine
 * @author Denis xmcdbx Safonov
 * @copyright Copyright (c) 2010
 * @version 0.1
 * @license GPL v.3 http://www.gnu.org/licenses/gpl.txt
 *
 */
echo
<<<END
************************************************************
*                                                          *
*                phpMyEngine shell installer               *
*                                                          *
*              Author:  Denis "xmcdbx" Safonov             *
*                     Copyright (c) 2010                   *
*   License: GPL v.3 http://www.gnu.org/licenses/gpl.txt   *
*                                                          *
************************************************************


END;
$defaultWebroot = __DIR__.'/public';
$defaultEngine = __DIR__.'/phpmyengine';
$pathWebroot = \readline ('Enter webroot path ['.$defaultWebroot.']: ' );
$pathEngine = \readline ('Enter phpmyengine path ['.$defaultEngine.']: ' );
echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;

echo $pathWebroot;

echo PHP_EOL;
echo PHP_EOL;
echo PHP_EOL;
