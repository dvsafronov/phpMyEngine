<h2>Extensions</h2>
<table class="list">
    <thead>
        <tr>
            <td width="18%">Название</td>
            <td width="8%">Версия</td>
            <td width="20%">Автор</td>
            <td>Описание</td>
            <td width="8%">Действия</td>
        </tr>
    </thead>
    <tbody>
    {section name=list loop=$optInfo}
        <tr {cycle values=',class="sec"'}>
            <td>{$optInfo[list]->extension}</td>
            <td>{$optInfo[list]->version}</td>
            <td>{$optInfo[list]->author}</td>
            <td>{$optInfo[list]->description}</td>
            <td>-</td>
        </tr>
    {/section}
    </tbody>
</table>