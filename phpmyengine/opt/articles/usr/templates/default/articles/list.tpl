<div class="block">
{if $categoryTitle}<h2 class="catTitle">{$categoryTitle}</h2>{/if}

{section name=list loop=$recordsList->records}
    {include file="articles/preview.tpl" myRecord=$recordsList->records[list]}
{/section}
{insert name="widget" widget="pagination" pages="{$paginationCountPages}"}
</div>