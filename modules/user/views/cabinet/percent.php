<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Percent;


use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

use yii\grid\GridView;

$dataProvider = new ActiveDataProvider([
    'query' => Percent::find()->where(['created_by' => Yii::$app->user->identity->id]),
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
                    return Url::to(['/jk/percent/update' ,'id'=>$data->id], true);
                },
            ],
            'created_at:datetime',
            'compensation_count:decimal',
            'compensation_years',
            [
                'label'=>'Заявка',
                'value'=>'order.id',
                'class' => LinkColumn::class,
                'url' => function ($data) {
                    if (isset($data->order)){
                        $i =  Url::to(['/jk/order/view' ,'id'=>$data->order->id], true);
                        return Url::to(['/jk/order/view' ,'id'=>$data->order->id], true);
                    }else{
                        return false;
                    }
                },
            ],
            [
                'class' => ActionColumn::class,
                'controller' => '/jk/percent',
                'template'=>'{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(Icon::show('calculator'), $url, [
                            'class'=>'btn btn-sm btn-success',
                            'title' => 'Посмотреть параметры расчёта',
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]
) ?>