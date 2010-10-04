<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" type="text/css" href="/design/default/style.css" />
        <title></title>
    </head>
    <body>
        <div class="ad"></div>
        <div id="gspot">
            <div class="decor1"></div>
            <div id="header">
                <div id="headBar">
                    <a href="/">
                        <img src="/design/default/images/phpMyEngine24.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             width="144"
                             height="23"
                             />
                    </a>
                </div>
                <div id="menuBar">
                     {insert name="widget" widget="menu"}
                </div>
            </div>
            <div id="middle">
                <div id="westCoast">                   
                       {insert name="widget" widget="controller"}
                </div>
                <div id="eastCoast">
                    {include file="sidebar.tpl"}
                </div>
                <div class="cls"></div>
            </div>
        </div>
        <div id="footer">
            <div class="divny">
                <div class="left">
                    <!--phpMyEngine::debugInfo/-->
                </div>
                <div class="middle">
                    &copy; 2010 phpMyEngine
                </div>
                <div class="right">
                    <a href="http://mcdb.ru/phpmyengine/">
                        <img src="/design/default/images/phpMyEngine32.png"
                             alt="phpMyEngine"
                             title="phpMyEngine"
                             width="144"
                             height="32"
                             />
                    </a>
                </div>
                <div class="cls"></div>
            </div>
        </div>
    </body>
</html>