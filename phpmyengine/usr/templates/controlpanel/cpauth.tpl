{include file="_header.tpl"}
<div class="block auth">
    <h2>Need auth</h2>
    {if $_messages}
        {include file="_messages.tpl"}
    {/if}
    <form method="POST" action="{"cpauth"|cplink}" class="editrecord">
        <label>Login:</label>
        <input type="text" name="login" value="{$cplogin}" />
        <label>Password:</label>
        <input type="password" name="password" />
        <input type="submit" value="Send" />
</div>
</form>
{include file="_footer.tpl"}