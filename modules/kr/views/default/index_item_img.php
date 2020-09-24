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
            <h4><?= Html::a( $item['title'], Url::to($item['url'])); ?></h4>
        </div>
    </div>
</div>