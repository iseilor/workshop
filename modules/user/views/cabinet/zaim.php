<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Percent;


use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => \app\modules\jk\models\Zaim::find()->where(['created_by' => Yii::$app->user->identity->id]),
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
                    return Url::to(['/jk/zaim/' . $data->id], true);
                },
            ],
            'created_at:datetime',
            'compensation_count:decimal',
            'compensation_years',
            [
                'class' => ActionColumn::class,
                'controller' => '/jk/percent',
            ],
        ],
    ],

) ?>