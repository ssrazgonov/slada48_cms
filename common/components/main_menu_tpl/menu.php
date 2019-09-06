<li class="nav-item">

    <a class="nav-link" href="<?= $item['url'] ?>">
        <?= $item['name']?>
        <?php if( isset($item['childs']) ): ?>
            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
        <?php endif;?>
    </a>
    <?php if( isset($item['childs']) ): ?>
        <ul class="sub-menu">
            <?= $this->getMenuHtml($item['childs'])?>
        </ul>
    <?php endif;?>
</li>