<div class="container_24" style="margin-bottom: 24px;font-size: 11px">
    <div class="grid_8">
        <b>Общие</b>:<br>
        Время генерации: {$_debugInfo['genTime']} сек<br>
        Использовано памяти: {$_debugInfo['memory']} Кб<br>
        Вложено файлов: {$_debugInfo['includedFiles']} шт.<br>
        Размер HTML: {$_debugInfo['HTML']}Кб<br>
        
    </div>
    <div class="grid_8">
        <b>База данных</b>:<br>
        Профиль: {$_debugInfo['dbProfile']}<br>
        Тип: {$_debugInfo['dbType']}<br>
        Запросов: {$_debugInfo['dbSuccessQueries']} / {$_debugInfo['dbErrorQueries']}<br>
        Время: {$_debugInfo['dbTime']} сек<br>
    </div>
    <div class="grid_8">
        <b>Кэш:</b>
    </div>
    <div class="clear"></div>
</div>
