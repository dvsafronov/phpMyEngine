<h2>Configure</h2>
<form action="#" method="POST">
    <fieldset>
        <legend>Design</legend>
        <select name="skin">
            <option>coldblue</option>
            <option>modern</option>
        </select>
    </fieldset>

    <fieldset>
        <legend>Ad</legend>
    </fieldset>

    <fieldset>
        <legend>Statistics</legend>
        <fieldset>
            <legend><input type="checkbox" id="useGA" name="useGA"> <label for="useGA">Google Analytics</label></legend>
            <label>ID:</label>
            <input type="text" name="gaCode" value="{$gaCode}">
        </fieldset>
        <fieldset>
            <legend><input type="checkbox" id="useYAM" name="useYAM"> <label for="useYAM">Яндекс.Метрика</label></legend>
            <label>ID:</label>
            <input type="text" name="yamCode" value="{$yamCode}">
        </fieldset>
    </fieldset>

    <input type="submit" value="Save">
</form>