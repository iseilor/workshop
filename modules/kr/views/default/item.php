<?php

/* @var $model app\modules\kr\models\Block */

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url; ?>


<a href="<?=Url::to(['/kr/timetable/'.strtolower($model->code)])?>" class='small-box-footer'>
    <div class="small-box bg-gradient-<?= $model->color ?>">
        <div class="inner">
            <h3><?= $model->title ?></h3>
            <p><?= $model->subtitle ?></p>
        </div>
        <div class="icon"><?= Icon::show($model->icon) ?></div>
    </div>
</a>