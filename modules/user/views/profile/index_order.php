<?php
/* @var $orderDataProvider yii\data\ActiveDataProvider */

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\OrderStatus;
use yii\grid\GridView;
use yii\helpers\Url; ?>

<h3>Мои заявки по жилищной кампании</h3>
<?= GridView::widget(
    [
        'dataProvider' => $orderDataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'id',
                'url' => function ($data) {
                    return Url::to(['/jk/order/' . $data->id]);
                },
            ],
            'created_at:datetime',
            [
                'label' => 'Статус',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = OrderStatus::findOne($data['status_id']);
                    return $status->getStatusLabel();
                }
            ],
            [
                'label' => 'Прогресс',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = OrderStatus::findOne($data['status_id']);
                    return $status->getProgressBar();
                }
            ],
            [
                'class' => ActionColumn::className(),
                'controller' => '/jk/order',
            ]
        ],
    ]
) ?>