<?php

namespace phpMyEngine\Template;

use phpMyEngine\Config\Config;

$_debugInfo = g('_debugInfo');
$dbStat = $_debugInfo['dbStat'];
?>
<div style="font-size: 10px;">
    <div class="container text-left">
        <div class="controls controls-row">
            <div class="span4">
                <h5 class="page-header">Общие</h5>
                <dl class="dl-horizontal">
                    <dt>Время генерации:</dt>
                    <dd><?php ef($_debugInfo['genTime']) ?>сек</dd>
                    <dt>Использовано памяти:</dt>
                    <dd><?php ef($_debugInfo['memory']) ?>Кб</dd>
                    <dt>Вложено файлов:</dt>
                    <dd><?php ef($_debugInfo['includedFiles']) ?>шт.</dd>
                    <dt>Размер HTML:</dt>
                    <dd><?php ef($_debugInfo['HTML']) ?>Кб</dd>
                </dl>

            </div>
            <?php
            /* @var $statItem \phpMyEngine\Database\StatisticItem */
            foreach ($dbStat as $profile => $statItem):
                $dbType = Config::getInstance()->$profile->type;
                ?>
                <div class="span2">
                    <h5 class="page-header">База данных</h5>
                    <dl>
                        <dt>Профиль:</dt>
                        <dd><?php ef($profile) ?></dd>
                        <dt>Тип:</dt>
                        <dd><?php ef($dbType) ?></dd>
                        <dt>Запросов:</dt>
                        <dd><?php ef($statItem->countQueries) ?> / <?php ef($statItem->countErrorQueries) ?></dd>
                        <dt>Время:</dt>
                        <dd><?php ef(round($statItem->time, 5)) ?> сек</dd>
                    </dl>
                </div>
            <?php
            endforeach;
            ?>
            <?php if ($_debugInfo['cacheEnabled']): ?>
                <div class="span2">
                    <h5 class="page-header">Кэш:</h5>
                    <dl>
                        <dt>Профиль:</dt>
                        <dd><?php ef($_debugInfo['cacheProfile']) ?></dd>
                        <dt>Тип:</dt>
                        <dd><?php ef($_debugInfo['cacheType']) ?></dd>
                        <dt>Запросов:</dt>
                        <dd><?php ef($_debugInfo['cacheRequests']) ?></dd>
                        <dt>Время:</dt>
                        <dd><?php ef($_debugInfo['cacheTime']) ?> сек</dd>
                    </dl>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>