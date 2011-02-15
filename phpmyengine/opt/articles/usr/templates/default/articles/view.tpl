<div class="block">
    <h2>{$myRecord->mutagenData->title}</h2>
    {$myRecord->mutagenData->content|escape:"htmlall"|nl2br|bbcode|cutcut}
    {include file="articles/_recordinfo.tpl"}
        {insert name="widget" widget="shares"}
</div>
