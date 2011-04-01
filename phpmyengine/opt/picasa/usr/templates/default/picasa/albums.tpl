<h2>Альбомы</h2>

{foreach from=$albums item="album"}

<div class="grid_15 albumLine">
    <div class="grid_4 albumIcon">
        <a href="{"picasa/{$album->id}/view"|sitelink}" style="background-image: url({$album->cover})">
           <span></span>
        </a>
    </div>
    <div class="grid_10 albumInfo">
        <h3><a href="{"picasa/{$album->id}/view"|sitelink}" title="{$album->title}">{$album->title}</a></h3>
        <span>Изображений: {$album->count}</span>
    </div>
    <div class="clear"></div>
</div>
{/foreach}
<style type="text/css">
    {literal}
    div.albumLine {
        margin-bottom: 24px;background: #F6F6F2;
    }
    div.albumIcon a {
        width: 128px;
        height: 128px;        
        display: block;
        border-radius: 8px;
        -moz-border-radius: 8px;
        border: 1px solid #eee;
        background: url() no-repeat center;
    }
    div.albumInfo h3 {
        margin: 0;
        padding: 0;
    }
    div.albumInfo span {
        font-size: 12px;
    }
    {/literal}
</style>