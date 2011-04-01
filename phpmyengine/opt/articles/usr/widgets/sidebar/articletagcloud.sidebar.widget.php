<?php
namespace phpMyEngine\Widgets;

function articletagcloudWidget () {
    \phpMyEngine\loadModule ( 'tags' );
    $_myCache = \phpMyEngine\Cache\Cache::getInstance ();
    if (false === ($cloud = $_myCache->getValue ( '__tagcloudArticle' ))) {
        $cloud = \phpMyEngine\Modules\Tags\getCloud ( 'Article' );
        $_myCache->setValue ( '__tagcloudArticle', $cloud, 1 );
    }
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRender->setValue ( 'tagCloud', $cloud );
    $_myRender->renderTemplate ( 'articles/tags/cloud.tpl' );

    return null;
}

return getWidgetPriorty ( 'articles', 'tagCloud' );