<h2>List of static pages</h2>
<table class="list">
    <thead>
        <tr>
            <td width="10%">ID</td>
            <td>Заголовок</td>
            <td width="8%">Действия</td>
        </tr>
    </thead>
    <tbody>        
        {section name=list loop=$recordsList->records}
        <tr {cycle values=',class="sec"'}>
            <td>{$recordsList->records[list]->_id}</td>
            <td>{$recordsList->records[list]->mutagenData->title}</td>
            <td align="center">
                <a href="{"staticpage/{$recordsList->records[list]->_id}/edit"|cplink}">
                   <img src="/controlpanel/images/icons/001_45.png" width="24" height="24">
                </a>
                <a href="{"staticpage/{$recordsList->records[list]->_id}/delete"|cplink}">
                   <img src="/controlpanel/images/icons/001_05.png" width="24" height="24">
                </a>
            </td>
        </tr>
    {/section}
    </tbody>
</table>