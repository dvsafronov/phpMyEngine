{if $paginationCount > 1}
<div class="_paginationList grid_14">
    <h4>Страницы: (всего {$paginationCount})</h4>
    <ul class="_pagination">
        {section name=page start=0 loop=$paginationCount step=1}
        <li>
            {if $smarty.section.page.index+1 neq $paginationCurPage}
            <a href="{$paginationHREF}/page{$smarty.section.page.index+1}">{$smarty.section.page.index+1}</a>
            {else}
            <span class="curPage">{$smarty.section.page.index+1}</span>
            {/if}
        </li>
        &nbsp;
        {/section}
    </ul>
    <ul class="_pagination">
        {if $paginationCount > 12 and $paginationCurPage neq 1}
        <li><a class="fal" href="{$paginationHREF}/page1">Первая</a></li>
        {/if}

        {if $paginationCurPage neq 1}
        <li><a href="{$paginationHREF}/page{$paginationCount}">&larr; Предыдущая</a></li>
        {/if}

        {if $paginationCurPage neq $paginationCount}
        <li><a href="{$paginationHREF}/page{$paginationCount}">Следующая &rarr;</a></li>
        {/if}

        {if $paginationCount > 12 and $paginationCurPage neq $paginationCount}
        <li><a class="fal" href="{$paginationHREF}/page{$paginationCount}">Последняя</a></li>
        {/if}
    </ul>
</div>

<div class="_paginatioForm grid_1">
    <form action="/pagination" method="post" title="Перейти на страницу">
        <input type="hidden" name="href" value="{$paginationHREF}">
        <input type="text" name="pagenumber" value="0"> <input type="submit" value="&rarr;">
    </form>
</div>

<div class="clear"></div>
{/if}