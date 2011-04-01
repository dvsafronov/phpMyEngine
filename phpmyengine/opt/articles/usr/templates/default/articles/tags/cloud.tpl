<div class="block">
    <div class="tagCloud">
{foreach from=$tagCloud item=score key=tag}
        <a href="/articles/tagsearch/{$tag}" style="font-size: {$score*0.24}px">{$tag}</a>
{/foreach}
    </div>
</div>