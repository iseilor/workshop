<?php
/* @var $item Array */

use yii\helpers\Html; ?>

<div class="col-md-<?= $item['col'] ?>">
    <div class="small-box bg-gradient-<?= $item['bg'] ?>">
        <div class="inner">
            <h3><?= $item['title'] ?></h3>
            <p><?= $item['description'] ?></p>
        </div>
        <div class="icon"><?= $item['icon'] ?></div>
        <?= Html::a($item['link'],
                    $item['url'],
                    ['class' => 'small-box-footer']) ?>
    </div>
</div>