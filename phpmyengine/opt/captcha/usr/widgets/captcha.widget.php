<?php
namespace phpMyEngine\Widgets;

function captchaWidget () {
    $string = '';
    $length = 6;
    $letters = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz";
    $max = strlen ( $letters ) - 1;
    for ($i = 0; $i < $length; $i++) {
        $string .= substr ( $letters, rand ( 0, $max ), 1 );
    }
    if (!session_id ()) {
        session_start ();
    }
    $_SESSION['__captcha'] = sha1 ( \strtoupper ( $string ) );
    $colors = array ('#7d2f00', '#4d007d', '#850200', '#002685', '#038500');
    $bgs = array ('#05ff00', '#85fcea', '#fcf385', '#c385fc');
    $imageCaptcha = new \Imagick();
    $drawCapthca = new \ImagickDraw();
    $drawCapthca->setFillColor ( new \ImagickPixel ( $colors[array_rand ( $colors )] ) );
    $fontFile = \phpMyEngine\EngineFileSystem\getRealFilePath ( 'font.ttf', 'usr' );
    $drawCapthca->setFont ( $fontFile );
    $drawCapthca->setFontSize ( 32 );
    $angle = rand ( -12, 12 );
    $metrix = $imageCaptcha->queryFontMetrics ( $drawCapthca, $string );
    $imageCaptcha->newImage ( 196, 72, $bgs[array_rand ( $bgs )] );
    $imageCaptcha->annotateImage ( $drawCapthca, 196 - $metrix['textWidth'] - rand ( 12, 64 ), rand ( 42, 56 ), $angle, $string );
    $imageCaptcha->drawImage ( $drawCapthca );
    $imageCaptcha->swirlImage ( 32 );
    $imageCaptcha->blurImage ( 3, 1 );
    $bgFile = \phpMyEngine\EngineFileSystem\getRealFilePath ( 'captcha.png', 'usr' );
    $bgCaptcha = new \Imagick ( $bgFile );
    $bgCaptcha->swirlImage ( rand ( 120, 240 ) );
    $bgCaptcha->blurImage ( 6, 2 );
    $bgCaptcha->compositeImage ( $imageCaptcha, \Imagick::COMPOSITE_DIFFERENCE, 0, 0 );
    $bgCaptcha->setImageFormat ( 'png' );
    $dataURI = "data:image/png;base64," . base64_encode ( $bgCaptcha );
    $imageCaptcha->destroy ();
    $bgCaptcha->destroy ();
    $drawCapthca->destroy ();
    unset ( $angle, $metrix, $drawCapthca, $bgCaptcha, $imageCaptcha, $bgs, $colors, $max, $length, $letters, $string, $bgFile );
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRender->setValue ( 'captcha', $dataURI );
    $_myRender->renderTemplate ( 'captcha.tpl' );
    return null;
}
