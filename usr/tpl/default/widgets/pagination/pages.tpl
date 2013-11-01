<?php

namespace phpMyEngine\Template;

$paginationCount = g('paginationCount');
$paginationCurPage = g('paginationCurPage');
$paginationHREF = g('paginationHREF');

$calcLine = g('paginationCalcLine');

$o = 15; // элементов в строке

list($from, $to) = $calcLine($paginationCurPage, $o, $paginationCount);
?>
<?php if ($paginationCount > 1) : ?>
<h4>Страницы: (всего <?php echo $paginationCount ?>)</h4>
<div class="row">
    <div class="span8">
        <div class="pagination">
            <ul>
                <?php for ($i = $from; $i < $to; $i++) : ?>
                <?php if ($i + 1 != $paginationCurPage): ?>
                    <li>
                        <a href="<?php echo $paginationHREF ?>/page<?php echo ($i + 1) ?>"><?php echo ($i + 1) ?></a>
                    </li>
                    <?php else: ?>
                    <li class="active disabled"><span><?php echo ($i + 1) ?></span></li>
                    <?php endif ?>
                <?php endfor ?>
            </ul>
        </div>
        <div class="pager">
            <ul>
                <?php if ($paginationCount > 1 and $paginationCurPage != 1) : ?>
                <li><a class="fal" href="<?php echo $paginationHREF ?>/page1">Первая</a></li>
                <?php else: ?>
                <li class="disabled"><span>Первая</span></li>
                <?php endif ?>

                <?php if ($paginationCurPage != 1) : ?>
                <li><a href="<?php echo $paginationHREF ?>/page<?php echo ($paginationCurPage - 1) ?>">&larr;
                    Предыдущая</a></li>
                <?php else: ?>
                <li class="disabled"><span>&larr; Предыдущая</span></li>
                <?php endif ?>

                <?php if ($paginationCurPage != $paginationCount) : ?>
                <li>
                    <a href="<?php echo $paginationHREF ?>/page<?php echo ($paginationCurPage + 1) ?>">Следующая &rarr;</a>
                </li>
                <?php else: ?>
                <li class="disabled"><span>Следующая &rarr;</span></li>
                <?php endif ?>

                <?php if ($paginationCount > 1 and $paginationCurPage != $paginationCount) : ?>
                <li><a class="fal"
                       href="<?php echo $paginationHREF ?>/page<?php echo ($paginationCount) ?>">Последняя</a></li>
                <?php else: ?>
                <li class="disabled"><span>Последняя</span></li>
                <?php endif ?>
            </ul>
        </div>
    </div>
    <div class="span1 text-right">
        <form class="form-inline" action="/pagination" method="post" title="Перейти на страницу">
            <input type="hidden" name="href" value="<?php echo $paginationHREF ?>">
            <input class="input-block-level" type="text" name="pagenumber" value="" placeholder="0">
            <button class="btn btn-block type=" submit
            "><i class="icon-arrow-right"></i></button>
        </form>
    </div>
</div>

<?php endif ?>