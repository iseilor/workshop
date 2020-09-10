<?php
/* @var $item \app\modules\news\models\News */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-3 d-flex align-items-stretch">
    <div class="card">
        <div class="card-body">
            <?php
            $img = Html::img(
                Yii::$app->homeUrl . Yii::$app->params['module']['news']['path'] . $item->id . '/' . $item->img,
                [
                    'alt' => $item->title,
                    'class' => 'img-fluid pad mb-1',
                ]
            );
            echo Html::a($img, Url::to(['/news/' . $item->id], ['title' => $item->title]));
            ?>
            <h5><?=Html::a($item->title,Url::to(['/news/' . $item->id])); ?></h5>

            <!--
            <?= Html::a('<i class="far fa-calendar-alt"></i> ' . Yii::$app->formatter->format($item->created_at, 'datetime'), '#', ['title' => 'Дата публикации']); ?>
            <?= Html::a('<i class="fas fa-eye"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во просмотров']); ?> |
            <?= Html::a('<i class="fas fa-comments"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во комментариев']); ?> |
            <?= Html::a('<i class="fas fa-heart"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во лайков']); ?>
-->
        </div>
        <div class="card-footer">
            <?= Html::tag('small','<i class="far fa-calendar-alt"></i> Дата публикации: ' . Yii::$app->formatter->format($item->created_at, 'datetime'), ['title' => 'Дата публикации']); ?>
        </div>
    </div>
</div>