<h2>Logs list</h2>
<ul>
{section name=list loop=$logsList}
    <li>
        <a href="{"logs/{$logsList[list]}"|cplink}">{$logsList[list]|date_format:"%A, %e %b, %Y"}</a>
    </li>
{/section}
</ul>