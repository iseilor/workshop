<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;

use app\modules\jk\models\Order;
use app\modules\jk\models\Status;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => Order::find()->where(['created_by' => Yii::$app->user->identity->id]),
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
                    return Url::to(['/jk/order/' . $data->id], true);
                },
            ],
            'created_at:datetime',
            [
                'label' => 'Статус',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = Status::findOne($data['status_id']);
                    return $status->getStatusLabel();
                }
            ],
            [
                'label' => 'Прогресс',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = Status::findOne($data['status_id']);
                    return $status->getProgressBar();
                }
            ],
            [
                'class' => ActionColumn::class,
                'controller' => '/jk/percent',
            ],
        ],
    ]
) ?>