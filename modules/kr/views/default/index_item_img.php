<?php
/* @var $item Array */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-3">
    <div class="card">
        <div class="card-body">
            <?php
            $img = Html::img(Yii::$app->homeUrl . 'img/kr/' . $item['src'],
                [
                    'alt' => $item['title'],
                    'class' => 'img-fluid pad',
                ]
            );
            echo Html::a($img, $item['url'], ['title' => $item['title']]); ?>
            <h3><?= Html::a($item['icon'] . ' ' . $item['title'], Url::to($item['url'])); ?></h3>
        </div>
    </div>
</div>