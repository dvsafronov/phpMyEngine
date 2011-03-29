<div class="block">
    <h2>Рубрикатор</h2>
    <ul class="categorylist">
{section name=list loop=$recordsList->records}
        <li>
            <a href="{"articles/category/{$recordsList->records[list]->_id}/list"|sitelink}">{$recordsList->records[list]->mutagenData->title}</a>
                <span class="announcement">{$recordsList->records[list]->mutagenData->announcement}</span>
        </li>
{/section}
    </ul>
    {insert name="widget" widget="pagination" pages="{$paginationCountPages}"}
</div>