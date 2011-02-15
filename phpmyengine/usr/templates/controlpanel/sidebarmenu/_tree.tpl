{if $tree}
<ul>
{foreach from=$tree key="name" item="href"}
    {if $name neq "#seporator#"}
    <li>
        {if is_array($href)}
        <b>{$name}</b>
            {include file="sidebarmenu/_tree.tpl" tree=$href}
        {else}
        <a href="{$href|cplink}">{$name}</a>
        {/if}
    </li>
   {else}
    <li class="seporator"></li>
   {/if}

{/foreach}
</ul>
{/if}