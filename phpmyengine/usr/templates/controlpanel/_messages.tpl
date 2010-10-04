{if $_messages->caErrors gt 0}
<div class="block _messages error">
    <ul>
    {section name=error loop=$_messages->errors}
        <li>{$_messages->errors[error]}</li>
    {/section}
    </ul>
</div>
{/if}

{if $_messages->caWarnings gt 0}
<div class="block _messages warning">
    <ul>
    {section name=warning loop=$_messages->warnings}
        <li>{$_messages->warnings[warning]}</li>
    {/section}
    </ul>
</div>
{/if}

{if $_messages->caMessages gt 0}
<div class="block _messages">
    <ul>
    {section name=message loop=$_messages->messages}
        <li>{$_messages->messages[message]}</li>
    {/section}
    </ul>
</div>
{/if}
