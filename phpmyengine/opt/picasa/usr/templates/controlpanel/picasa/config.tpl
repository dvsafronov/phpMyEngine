<form method="POST" action="#">
    <fieldset>
        <legend>Settings</legend>
        <label>User:</label><input type="text" name="user" value="{$settings->user}">
        <label>Force album (ID):</label><input type="text" name="forceAlbum" value="{$settings->forceAlbum}">
        <label>Thumb width:</label><input type="text" name="width" value="{$settings->width}">
    </fieldset>
    <fieldset>
        <legend>Style</legend>
        <textarea rows="15" cols="*" name="style"></textarea>
    </fieldset>
    <input type="submit" value="Save">
</form>