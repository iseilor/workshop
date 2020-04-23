<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\chat\models\ChatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'message',
        'layout' => '{items}',
        'options' => [
            'tag' => false,
        ],
        'itemOptions' => [
            'tag' => false,
        ],
    ]
);