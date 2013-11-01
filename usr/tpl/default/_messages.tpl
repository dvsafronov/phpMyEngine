<?php

namespace phpMyEngine\Template;
?>
<div class="pme_messages">
    <?php if (g('_messages')->caErrors > 0): ?>
        <div class="alert alert-error">
            <ul class="unstyled">
                <?php for ($i = 0, $ca = g('_messages')->caErrors; $i < $ca; $i++): ?>
                    <li><?php echo g('_messages')->errors[$i] ?></li>
                <?php endfor ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (g('_messages')->caWarnings > 0): ?>
        <div class="alert alert-block">
            <ul class="unstyled">
                <?php for ($i = 0, $ca = g('_messages')->caWarnings; $i < $ca; $i++): ?>
                    <li><?php echo g('_messages')->warnings[$i] ?></li>
                <?php endfor ?>
            </ul>
        </div>
    <?php endif ?>

    <?php if (g('_messages')->caMessages > 0): ?>
        <div class="alert alert-info">
            <ul class="unstyled">
                <?php for ($i = 0, $ca = g('_messages')->caMessages; $i < $ca; $i++): ?>
                    <li><?php echo g('_messages')->messages[$i] ?></li>
                <?php endfor ?>
            </ul>
        </div>
    <?php endif ?>
</div>