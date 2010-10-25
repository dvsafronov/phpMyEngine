<div class="block">
    <h2>Регистрация</h2>
    {if $_messages}
        {include file="_messages.tpl"}
    {/if}
    <form method="POST" action="#">
        <label>Логин:</label>
        <input type="text" name="login">

        <label>Пароль:</label>
        <input type="password" name="password">

        <label>Повторите пароль:</label>
        <input type="password" name="rpassword">

        {insert name="widget" widget="captcha"}

        <input type="submit" value="Зарегистрироваться">
    </form>
</div>