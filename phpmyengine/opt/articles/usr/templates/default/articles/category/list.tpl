<div class="block">
    <h2>Рубрикатор</h2>
    <ul class="categorylist">
{section name=list loop=$recordsList->records}
        <li>
            <a href="{$recordsList->records[list]->_id|sitelink}">{$recordsList->records[list]->mutagenData->title}</a>
        </li>
{/section}
    </ul>
</div>