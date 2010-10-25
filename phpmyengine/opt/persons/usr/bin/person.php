<?php
namespace phpMyEngine\personController;

\phpMyEngine\loadModule ( 'persons' );

function defaultAction () {
    echo 'person';
}

function registrationAction () {
    $_myRender = \phpMyEngine\Render\Render::getInstance ();
    $_myRoute = \phpMyEngine\Route::getInstance();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $myMessages = new \phpMyEngine\Messages();
        $captchaCode = sha1 ( \strtoupper ( (string) filter_input ( INPUT_POST, 'captcha' ) ) );
        $password = (string) filter_input ( INPUT_POST, 'password' );
        $rpassword = (string) filter_input ( INPUT_POST, 'rpassword' );
        $login = (string) filter_input ( INPUT_POST, 'login', FILTER_VALIDATE_REGEXP, array (
                    'options' => array (
                        'regexp' => "/^[a-z0-9\-]{2,21}$/i")) );
        if (!\session_id()) {
            \session_start();
        }
        if ((isset ( $_SESSION['__captcha'] ) && $captchaCode != $_SESSION['__captcha'])) {
            $myMessages->addError ( 'Не правильно введён защитный код' );
        }
        if (($password == '' || $rpassword == '') && strlen ( $password ) < 8) {
            $myMessages->addError ( 'Пароль должен быть не менее 8 символов' );
        }
        if ($rpassword != $password) {
            $myMessages->addError ( 'Пароли не совпадают' );
        }
        if ($login == '') {
            $myMessages->addError ( 'Логин содержит запрещённые символы, либо не соответствует формату' );
        }

        $_myFilter = new \phpMyEngine\Persons\Filter();

        $_myRender->setValue ( '_messages', $myMessages );
        //var_dump ( $_SESSION );
    }
    $_myRender->renderTemplate ( 'persons/registration.tpl' );
}