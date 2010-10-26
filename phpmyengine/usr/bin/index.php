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
    //var_dump ( $c );

    $ar[0] = array ('_id' => 1, "xc" => "awrx", "mamb" => "dwrx");
    $ar[1] = array ('_id' => 3, "xc" => "bevo", "mamb" => "dx");
    $ar[2] = array ('_id' => 65, "xc" => "cvaz", "mamb" => "bc");
    $ar[3] = array ('_id' => 32, "xc" => "bsti", "mamb" => "afd ");

    $ara = array ('___order' => 1, '___orderBy' => 'mamb');

    usort ( $ara, function ($a, $b) use ($ara) {
                var_dump ( $a );
                $by = "mamb";
                $res = strcmp ( $a[$by], $b[$by] );
                return $res;
            } );
    //\var_dump ( $ar );

    $data = array (
        "_id" => \uniqid(),
        "helloTo" => "world",
        "helloFrom" => array (
            "name" => "Denis",
            "nickname" => "xmcdbx",
            "surname" => "Safronov"
        )
    );
}
