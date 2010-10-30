{include file="_parts/header.tpl"}
<div class="block auth">
    <h2>{"Need auth"|l10n:cpauth}</h2>
    {if $_messages}
        {include file="_messages.tpl"}
    {/if}
    <form method="POST" action="{"cpauth"|cplink}" class="editrecord">
        <label>{"Login"|l10n:cpauth}:</label>
        <input type="text" name="login" value="{$cplogin}" />
        <label>{"Password"|l10n:cpauth}:</label>
        <input type="password" name="password" />
        <input type="submit" value="{"Enter"|l10n:cpauth}" />
    </form>
</div>
{include file="_parts/footer.tpl"}