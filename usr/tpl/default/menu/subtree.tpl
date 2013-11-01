<?php

namespace phpMyEngine\Template;

$_tree = g('menuSubItems');
?>
<?php if ($_tree): ?>
    <ul class="dropdown-menu">
        <?php foreach ($_tree as $name => $href): ?>
            <?php if ($href != '#sep#'): ?>
                <li>
                    <?php if (is_array($href)): ?>
                        <?php ef($name) ?>  &darr;
                        <?php r()->insertTpl('menu/subtree.tpl') ?>
                    <?php else: ?>
                        <a href="<?php ef($href, 'sitelink') ?>"><?php ef($name) ?></a>
                    <?php endif ?>
                </li>
            <?php else: ?>
                <li class="divider"></li>
            <?php endif; ?>
        <?php endforeach ?>
    </ul>
<?php endif ?>


