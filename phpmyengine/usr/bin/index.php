<?php
namespace phpMyEngine\indexController;

use \phpMyEngine\Records\FilterOperation as FO;

function defaultAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();

    //$x = new \phpMyEngine\Persons\Profile ( 'user' );
    //echo $x;

    $myFilter = new \phpMyEngine\Records\Filter();
    //$myFilter->ratingPositive = FO::op ( FO::FOP_GT, 1 );
    //$myFilter->ratingPositive = FO::op ( FO::FOP_BETWEEN, 1, 7 );
    //$myFilter->ratingPositive = FO::op ( FO::FOP_NOTIN, array('1','7','0') );
    //$myFilter->tags = FO::op ( FO::FOP_ALL, array ('тег', 'хуй', 'рассказ', 'парни') );
    /* $myFilter->tags = 'tag';
      $myFilter->ratingPositive = 5;
      $myFilter->ratingNegative = 2; */
    $myFilter->mutagenType = 'StaticPage';
    $myFilter->ratingPositive = 5;
    $myFilter->mutagenData->title = 'Добро пожаловать!';
    $c = $myFilter->getRecords ();
    var_dump ( $c );
}
