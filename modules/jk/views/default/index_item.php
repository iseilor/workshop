<div class="col-md-<?= $item['col'] ?>">
    <a href="<?= $item['url'] ?>" class='small-box-footer'>
        <div class="small-box <?=$item['color']?>">
            <div class="inner">
                <h3><?=$item['title'] ?></h3>
                <p><?=$item['description'] ?></p>
            </div>
            <div class="icon">
                <?= $item['icon'] ?>
            </div>
        </div>
    </a>
</div>