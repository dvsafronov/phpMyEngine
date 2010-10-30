<div style="margin-bottom: 24px;font-size: 11px">
    <div style="float:left;margin-right: 24px;padding-bottom: 24px;">
        <b>Общие</b>:<br>
        Время генерации: {$_debugInfo['genTime']} сек<br>
        Использовано памяти: {$_debugInfo['memory']} Кб<br>
        Вложено файлов: {$_debugInfo['includedFiles']} шт.<br>
        Размер HTML: {$_debugInfo['HTML']}Кб<br>

    </div>
    <div style="float:left;margin-right: 24px;padding-bottom: 24px;">
        <b>База данных</b>:<br>
        Профиль: {$_debugInfo['dbProfile']}<br>
        Тип: {$_debugInfo['dbType']}<br>
        Запросов: {$_debugInfo['dbSuccessQueries']} / {$_debugInfo['dbErrorQueries']}<br>
        Время: {$_debugInfo['dbTime']} сек<br>
    </div>
    <div style="float:left">
        <b>Кэш:</b>
        {if {$_debugInfo['cacheEnabled']}}
        Включен
        {else}
        Отключен
        {/if}
        <br>
        Профиль: {$_debugInfo['cacheProfile']}<br>
        Тип: {$_debugInfo['cacheType']}<br>
        Запросов: {$_debugInfo['cacheSuccessQueries']} / {$_debugInfo['cacheErrorQueries']}<br>
        Время: {$_debugInfo['cacheTime']} сек<br>
    </div>
    <div style="clear: both"></div>
</div>
