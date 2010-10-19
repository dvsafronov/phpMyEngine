<div class="block">
    <h2>Рубрикатор</h2>
    <ul class="categorylist">
{section name=list loop=$recordsList->records}
        <li>
            <a href="{"articles/category/{$recordsList->records[list]->_id}/list"|sitelink}">{$recordsList->records[list]->mutagenData->title}</a>
        </li>
{/section}
    </ul>
</div>