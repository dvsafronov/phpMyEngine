<div class="block">
    <h2>
        <a href="/articles/{$myRecord->_id}/view" title="{$myRecord->mutagenData->title}">{$myRecord->mutagenData->title}</a>
    </h2>
    {$myRecord->mutagenData->content|escape:"htmlall"|nl2br|bbcode|cut:"/articles/{$myRecord->_id}/view"}
    {include file="articles/_recordinfo.tpl"}
</div>