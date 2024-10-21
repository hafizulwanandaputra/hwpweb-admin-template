<?php $pager->setSurroundCount(1) ?>

<nav aria-label="Page navigation">
    <ul class="pagination pagination-sm" style="--bs-pagination-border-radius: var(--bs-border-radius-lg);">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link bg-gradient" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link bg-gradient" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link bg-gradient">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-left"></i></span>
                </span>
            </li>
            <li class="page-item disabled">
                <span class="page-link bg-gradient">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                </span>
            </li>
        <?php endif; ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <?php if ($link['active']) : ?>
                    <span class="page-link bg-gradient">
                        <?= $link['title'] ?>
                    </span>
                <?php else : ?>
                    <a class="page-link bg-gradient" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link bg-gradient" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link bg-gradient" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                </a>
            </li>
        <?php else : ?>
            <li class="page-item disabled">
                <span class="page-link bg-gradient">
                    <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                </span>
            </li>
            <li class="page-item disabled">
                <span class="page-link bg-gradient">
                    <span aria-hidden="true"><i class="fa-solid fa-angles-right"></i></span>
                </span>
            </li>
        <?php endif; ?>
    </ul>
</nav>