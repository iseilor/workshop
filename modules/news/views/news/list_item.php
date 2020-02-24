<?php

use yii\helpers\Html;

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?= Html::img(Yii::$app->params['module']['news']['path'].'/'.$model->id.'/'.$model->img,
                    [
                        'alt' => $model->title,
                        'class' => 'img-fluid pad'
                    ]) ?>
            </div>
            <div class="col-md-8">
                <h1><?=$model->title;?></h1>
                <?=Html::a('Подробнее')?>

            </div>
        </div>
    </div>
</div>