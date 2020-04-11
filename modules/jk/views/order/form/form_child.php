<?php

// Дети текущего пользователя
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\ChildSearch;
use yii\grid\GridView;
use yii\helpers\Url;

$childSearch = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
$dataProvider = $childSearch->search([]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::className(),
            'attribute' => 'id',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        [
            'class' => LinkColumn::className(),
            'attribute' => 'fio',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        'date:date',
        'age',
        [
            'class' => ActionColumn::className(),
            'controller' => '/user/child',
        ],
    ],
]);