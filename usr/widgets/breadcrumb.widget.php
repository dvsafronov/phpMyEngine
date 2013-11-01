<?php

namespace phpMyEngine\Widgets;

function breadcrumbWidget() {
    return \phpMyEngine\Render\Render::getInstance()->renderTemplate('widgets/breadcrumb/placeholder.phtml');
}
