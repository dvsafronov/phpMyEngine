<?php

namespace phpMyEngine\Template;

$_tree = g('menuItems');
?>
<?php if ($_tree): ?>
<ul class="nav">
    <?php foreach ($_tree as $name => $href): ?>
    <?php if (is_array($href)): ?>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php ef($name) ?> <b class="caret"></b></a>
            <?php r()->setValue('menuSubItems', $href);
            r()->insertTpl('menu/subtree.tpl') ?>
        </li>
        <?php else: ?>
        <li>
            <a href="<?php ef($href, 'sitelink') ?>"><?php ef($name) ?></a>
        </li>
        <?php endif ?>

    <?php endforeach ?>
</ul>
<?php endif ?>

