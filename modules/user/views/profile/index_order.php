<?php
/* @var $orderDataProvider yii\data\ActiveDataProvider */

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

    <h3>Мои заявки по жилищной программе</h3>
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
                'class' => ActionColumn::className(),
                'controller' => '/jk/order',
                'template' => '{view} {history} {delete}',
                'buttons' => [
                    'history' => function ($url, $model) {
                        return Html::a(Icon::show('history'),
                                       Url::to(['/jk/order/' . $model->id . '/history']),
                                       ['class' => 'btn btn-sm btn-info','title'=>'История движения заявки']);
                    },
                ],
            ],
        ],
    ]
) ?>