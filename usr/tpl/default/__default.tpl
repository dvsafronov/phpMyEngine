<?php

namespace phpMyEngine\Template;

?>

<?php r()->insertTpl('_parts/header.tpl.php') ?>
<div class="row">
    <div class="span9">
        <div id="content">
            <?php r()->insertWidget('controller') ?>
        </div>
    </div>
    <aside class="span3">
        <?php r()->insertWidget('sidebar') ?>
    </aside>
</div>
<?php r()->insertTpl('_parts/footer.tpl.php') ?>
