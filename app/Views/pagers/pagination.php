<?php $pager->setSurroundCount(1) ?>

<!-- <nav aria-label="Page navigation"> -->
<ul class="pagination justify-content-center">
    <?php if ($pager->hasPrevious()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Awal') ?>">
                <span aria-hidden="true"><?= lang('Awal') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Sebelumnya') ?>">
                <span aria-hidden="true"><?= lang('Sebelumnya') ?></span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
            <a class="page-link" href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Selanjutnya') ?>">
                <span aria-hidden="true"><?= lang('Selanjutnya') ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Akhir') ?>">
                <span aria-hidden="true"><?= lang('Akhir') ?></span>
            </a>
        </li>
    <?php endif ?>
</ul>
<!-- </nav> -->