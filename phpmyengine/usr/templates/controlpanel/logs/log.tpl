<h2>View log for {$logDate|date_format:"%A, %e %b, %Y"}</h2>
<table class="list">
    <thead>
        <tr>
            <td width="10%">Time</td>
            <td width="*">Description</td>
            <td width="30%">URI</td>
            <td width="12%">IP</td>
        </tr>
    </thead>
    <tbody>
        {section name=list loop=$logContent}
        <tr {cycle values=',class="sec"'}>
            <td>{$logContent[list][0]}</td>
            <td>{$logContent[list][3]}</td>
            <td>{$logContent[list][1]}</td>
            <td>{$logContent[list][2]}</td>
        </tr>
        {/section}
    </tbody>
</table>
