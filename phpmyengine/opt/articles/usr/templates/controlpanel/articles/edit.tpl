<h2>Add article</h2>
    {if $_messages}
        {include file="_messages.tpl"}
    {/if}
<form action="#" method="POST" class="editrecord">
    <fieldset>
        {insert name="formelements" mutagen="{$mutagen}" values="{$myRecord->mutagenData->getValues()}"}
    </fieldset>
    <fieldset>
        <legend>Common properties</legend>
        <label>Tags:</label>
        <input type="text" id="tags" name="tags" value="{insert name="tags" tags="{$myRecord->tags}" action="list"}">
               <label>Status:</label>
        <select name="status">
        </select>
    </fieldset>
    <input type="Submit" value="Save">
</form>