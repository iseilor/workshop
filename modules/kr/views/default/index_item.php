<?php
/* @var $item Array */

use yii\helpers\Html; ?>

<div class="col-md-<?= $item['col'] ?>">
    <a href="<?= $item['url'] ?>" class='small-box-footer'>
        <div class="small-box bg-gradient-<?= $item['bg'] ?>">
            <div class="inner">
                <h3><?= $item['title'] ?></h3>
                <p><?= $item['title'] ?></p>
            </div>
            <div class="icon"><?= $item['icon'] ?></div>
        </div>
    </a>
</div>