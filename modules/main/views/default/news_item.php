<?php
/* @var $item \app\modules\news\models\News */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <?php
            $img = Html::img(
                Yii::$app->homeUrl . Yii::$app->params['module']['news']['path'] . $item->id . '/' . $item->img,
                [
                    'alt' => $item->title,
                    'class' => 'img-fluid pad',
                ]
            );
            echo Html::a($img, Url::to(['/news/' . $item->id], ['title' => $item->title]));
            ?>
            <h5 style="min-height: 72px;"><?=Html::a($item->title,Url::to(['/news/' . $item->id])); ?></h5>

            <?= Html::a('<i class="far fa-calendar-alt"></i> ' . Yii::$app->formatter->format($item->created_at, 'date'), '#', ['title' => 'Дата публикации']); ?> |
            <?= Html::a('<i class="fas fa-eye"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во просмотров']); ?> |
            <?= Html::a('<i class="fas fa-comments"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во комментариев']); ?> |
            <?= Html::a('<i class="fas fa-heart"></i> ' . rand(0, 100), '#', ['title' => 'Кол-во лайков']); ?>

        </div>
    </div>
</div>