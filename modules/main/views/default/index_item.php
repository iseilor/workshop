<?php
/* @var $item Array */

use yii\helpers\Html; ?>

<div class="col-xl-<?= $item['col'] ?>">
    <a href="<?= $item['url'] ?>" class='small-box-footer'>
        <div class="small-box bg-gradient-<?= $item['bg'] ?>">
            <div class="inner">
                <h4><?= $item['icon'] ?> <?= $item['title'] ?></h4>
                <p><?= $item['description'] ?></p>
            </div>
            <div class="icon"><?= $item['icon'] ?></div>
        </div>
    </a>
</div>