<?php

use app\components\grid\LinkColumn;
use app\modules\jk\models\Percent;
use http\Url;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => Percent::find()->where(['created_at' => Yii::$app->user->identity->id]),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
?>
<?= GridView::widget(
    [
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => LinkColumn::class,
                'attribute' => 'id',
                'url' => function ($data) {
                    return Url::to(['/jk/percent/' . $data->id], true);
                },
                'compensation_count:decimal',
                'compensation_years',
                [
                    'class' => ActionColumn::class,
                    'controller' => '/jk/percent',
                ],
            ],
        ],
    ]
) ?>