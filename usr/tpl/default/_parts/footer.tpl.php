</div> <!-- #mainContainer /-->
</section> <!-- #middle-->
</section> <!-- #wrapper-->

<section id="modals">
</section>

<!-- Footer
================================================== -->
<footer class="footer">
    <div class="container">
        <p>Все права очень сильно защищены очень сильными и честными законами этой страны. &copy; 2013 Культ-Афиша.</p>

        <ul class="footer-links">
            <li><a href="/about">О &laquo;Культ-Афише&raquo;</a></li>
            <li class="muted">&middot;</li>
            <li><a href="/corpblog">Блог</a></li>
            <li class="muted">&middot;</li>
            <li><a href="/">Франчайзинг</a></li>
            <?php if (!\phpMyEngine\Persons\isAuth()): ?>
                <li class="muted">&middot;</li>
                <li><a href="/person/resetpassword/">Восстановление пароля</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <!--phpMyEngine::debugInfo/-->
</footer>
<section id="_pme_data">
    <input type="hidden" name="_pme_current_user_id"
           value="<?= \phpMyEngine\Persons\CurrentPerson::getInstance()->_id ?>">
</section>
<script type="text/javascript" src="/phpmyengine/js/common.js"></script>
<script type="text/javascript" src="/phpmyengine/js/ready.js"></script>
<script type="text/javascript" src="/cult-affiche/js/ready.js"></script>
</body>
</html>
