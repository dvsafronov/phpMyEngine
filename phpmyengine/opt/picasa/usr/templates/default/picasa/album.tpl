<h1>{$album->title}</h1>
{foreach from=$album->images item="image"}
<a href="{$image->fullURL}" rel="picasa" style="background: url({$image->thumbURL})">
    <img src="{$image->thumbURL}"
         width="{$image->thumbWidth}" height="{$image->thumbHeight}"
         alt="{$image->title}" title="{$image->title}" />
</a>
{/foreach}
<div class="clear"></div>
<style type="text/css">
    a[rel="picasa"] {
        display: block;
        width: 144px;
        height: 120px;
        float: left;
        text-align: center;
        border: 1px solid #ccc;
        margin: 0 12px 12px 0;
        padding: 6px;
    }
    a[rel="picasa"] img {
        display: none;
    }
</style>