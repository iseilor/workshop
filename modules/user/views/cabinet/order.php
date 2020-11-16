<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;

use app\modules\jk\models\Order;
use app\modules\jk\models\Status;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => Order::find()->where(['created_by' => Yii::$app->user->identity->id, 'deleted_at' => null]),
    'pagination' => [
        'pageSize' => 20,
    ],
]);
\app\modules\jk\assets\JkOrderAsset::register($this);
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
                },
            ],
            [
                'label' => 'Прогресс',
                'format' => 'raw',
                'value' => function ($data) {
                    $status = Status::findOne($data['status_id']);
                    return $status->getProgressBar();
                },
            ],
            [
                'class' => ActionColumn::class,
                'controller' => '/jk/order',
                'template' => '{manager} {view} {update}',
                'buttons' => [

                    // Кнопка повторной отправки письма руководителю, если заявка находится в статусе "Согласование руководителями"
                    'manager' => function ($url, $model, $key) {
                        if ($model->status->code == 'MANAGER_WAIT') {
                            return Html::a(Icon::show('envelope'), $url, [
                                'class' => 'btn btn-sm btn-warning btn-manager',
                                'title' => 'Отправить повторное уведомление руководителю',
                                'data-pjax' => '0',
                            ]);
                        } else {
                            return '';
                        }
                    },
                ],
            ],
        ],
    ]
) ?>