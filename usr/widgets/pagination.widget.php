<?php
namespace phpMyEngine\Widgets;

function paginationWidget($params) {
    $_myRender = \phpMyEngine\Render\Render::getInstance();
    $_myRoute = \phpMyEngine\Route::getInstance();
    $isReverse = isset($params['reverse']) && $params['reverse'] == true;
    $countPages = (int) $params['pages'];
    if ($countPages <= 1) {
        return;
    }
    if ($_myRoute->page == 0 && $countPages > 0) {
        $_myRoute->page = $isReverse == false ? 1 : $countPages;
    }

    $href = preg_replace('/(\/page([0-9]+))/', '', $_SERVER['REQUEST_URI']);

    if (\phpMyEngine\isAJAXRequest()) {
        //ajax?
    }

    $_myRender->setValue('paginationCount', $countPages);
    $_myRender->setValue('paginationCurPage', $_myRoute->page);
    $_myRender->setValue('paginationHREF', $href);

    $_myRender->setValue('paginationCalcLine', function ($p, $o, $mp) {
        $right = (int) ($p + ceil(($o - 1) / 2));
        $left = (int) ($p - ceil(($o - 1) / 2));

        if ($o > $mp) {
            $o = $mp;
        }

        if ($left <= 0 || $left == 1) {
            $left = 0;
        }

        if ($right - $left < $o) {
            $right = $left + $o;
        }

        if ($right - $left > $o) {
            $right = $right - 1;
        }

        if ($right > $mp) {
            $right = $mp;
            $left = $right - $o;
        }

        return [$left, $right];
    });

    $_myRender->renderTemplate('widgets/pagination/pages'.($isReverse ? '_rev' : '').'.tpl');
}
