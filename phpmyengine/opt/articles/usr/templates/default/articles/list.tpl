<div class="block">
<h2 class="catTitle">{$categoryTitle}</h2>
{section name=list loop=$recordsList->records}
    {include file="articles/preview.tpl" myRecord=$recordsList->records[list]}
{/section}
</div>