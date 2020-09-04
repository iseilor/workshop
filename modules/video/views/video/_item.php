<?php
/* @var $model app\modules\video\models\Video */
?>

<div class="card">
    <div class="card-body">
        <a href="<?=Yii::$app->homeUrl?>files/video/<?= $model->video ?>" data-toggle="lightbox" data-title="<?= $model->title ?>" data-type="video">
            <img class="img-fluid mb-1" src="<?=Yii::$app->homeUrl?>files/video/<?= $model->img ?>" style="border-radius: 0.25rem;">
            <h6 style="text-align: center;"><?= $model->title ?></h6>
        </a>
    </div>
</div>