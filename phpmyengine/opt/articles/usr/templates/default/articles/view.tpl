<div class="block">
    <h2>{$myRecord->mutagenData->title}</h2>
    {$myRecord->mutagenData->content|escape:"htmlall"|nl2br|bbcode}
    {if $myRecord->tags}
    <div class="tags">
        <span></span>
        <ul>
        {foreach from=$myRecord->tags key="key" item="value" name="tags"}
            <li>
                <a href="{"tagsearch/Article/{$value}"|sitelink}">{$value}</a>
                {if !$smarty.foreach.tags.last}
                ,
                {/if}
            </li>
        {/foreach}
        </ul>
    </div>
    <div class="cls"></div>
    {/if}
    <div class="recordInfo">
        <div class="votePositive">
            <a href="#" title="+">+</a>
        </div>
        <div class="votes">+{$myRecord->ratingPositive} / -{$myRecord->ratingNegative}</div>
        <div class="voteNegative">
            <a href="#" title="-">-</a>
        </div>
        <div class="username">
            <span></span> <a href="#">{$username}</a>
        </div>
        <div class="date">
            <span></span>
            <a href="/archive/Article/{$myRecord->getCreationTime()|date_format:"%d%m%Y"}">
                {$myRecord->getCreationTime()|date_format:"%A, %e %b %Y, %H:%M"}
            </a>
        </div>
        <div class="favorites"><a href="#"><span>*</span></a></div>
        <div class="link"><a href="#"><span>#</span></a></div>
        <div class="comments"><span></span> 3200</div>
    </div>
</div>