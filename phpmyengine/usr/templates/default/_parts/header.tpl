<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <title>phpMyEngine. Бесплатная CMS с открытым исходным кодом. Opensource PHP CMS. Официальный сайт</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

        {insert name="css" file="/css/960_24_col.css"}
        {insert name="css" file="/css/reset.css"}
        {insert name="css" file="/css/text.css"}

        {insert name="css" file="/skins/{$__skin}/css/{$__skin}.css"}
        {insert name="css" file="/skins/{$__skin}/css/navigation.css"}
        {insert name="css" file="/skins/{$__skin}/css/style.css"}
    </head>
    <body>
        <div id="advertising_banner">
        
        </div>
        <div id="header">
            <div class="container_24 headbar">
                <div class="grid_10">
                    <a href="/">
                        <img src="/skins/{$__skin}/images/pmelogo.png"
                             width="238"
                             height="36"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             />
                    </a>
                </div>
                <div class="grid_14">
                    {insert name="widget" widget="person"}
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div id="navigation">
            <div class="container_24">
                {insert name="widget" widget="menu"}
            </div>
            <div class="clear"></div>
        </div>

        <div id="middle">
            <div class="container_24">

