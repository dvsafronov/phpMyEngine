<h2>Add static page</h2>
    {if $_messages}
        {include file="_messages.tpl"}
    {/if}
<form action="#" method="POST" class="editrecord">
    <fieldset>
        {insert name="formelements" mutagen="staticpage" values="{$myRecord->mutagenData->getValues()}"}
    </fieldset>
    <input type="Submit" value="Save">
</form>