<div class="block">
    <h1>{$myRecord->mutagenData->title}</h1>
    {$myRecord->mutagenData->content|escape:"htmlall"|nl2br|bbcode}    
</div>
{insert name="widget" widget="shares"}
