<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">

                <?php
                $img = Html::img(
                    Yii::$app->homeUrl . Yii::$app->params['module']['news']['path'] . $model->id . '/' . $model->img,
                    [
                        'alt' => $model->title,
                        'class' => 'img-fluid pad'
                    ]
                );
                echo Html::a($img, Url::to(['/news/' . $model->id], ['title' => $model->title]));

                ?>
            </div>
            <div class="col-md-9">
                <?= Html::a('<h1>' . $model->title . '</h1>', Url::to(['/news/' . $model->id]), ['title' => $model->title]) ?>
                <div>
                    <?= $model->annotation ?>
                </div>

                <?= Html::tag('small','<i class="far fa-calendar-alt"></i> Дата публикации: ' . Yii::$app->formatter->format($model->created_at, 'datetime'), ['title' => 'Дата публикации']); ?>
                <!--
                <?= Html::a('<i class="fas fa-eye"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во просмотров']); ?> |
                <?= Html::a('<i class="fas fa-comments"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во комментариев']); ?> |
                <?= Html::a('<i class="fas fa-heart"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во лайков']); ?>
                <?= Html::a('<i class="fab fa-readme"></i> Читать подробнее', Url::to(['/news/' . $model->id]), ['class' => 'btn btn-info float-right', 'title' => $model->title]); ?>
                -->
            </div>
        </div>
    </div>
</div>
