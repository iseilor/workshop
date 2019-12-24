<?php
use yii\helpers\Html;
?>

    <div class="info-box">
        <a class="info-box-icon bg-info elevation-1"
           href="<?= Yii::$app->homeUrl . 'doc/' . $model->src; ?>"><i class="fas fa-file-word"></i></a>
        <div class="info-box-content">
            <span class="info-box-text" style="white-space: normal;"><?= Html::encode
                ($model->title)
                ?></span>
            <span class="info-box-number">
                <!-- TODO: Сделать хранение файлов в модуле-->
                <a href="<?= Yii::$app->homeUrl . 'doc/' . $model->src; ?>">Скачать</a>
                </span>
        </div>
    </div>
