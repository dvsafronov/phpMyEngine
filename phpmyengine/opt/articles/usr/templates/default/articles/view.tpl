<div class="block">
    {if $categoryTitle}
    <h2 class="catTitle"><a href="/articles/category/{$myRecord->mutagenData->category}/list">{$categoryTitle}</a></h2>
        {/if}
    <h2>{$myRecord->mutagenData->title}</h2>

    {$myRecord->mutagenData->content|escape:"htmlall"|nl2br|bbcode|cutcut}
    {include file="articles/_recordinfo.tpl"}
        {insert name="widget" widget="shares"}
</div>
