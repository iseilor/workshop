<?php

use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\jk\models\Agreement;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


Pjax::begin();
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::class,
            'attribute' => 'id',
            'controller' => '/jk/agreement/view',
        ],
        [
            'format'=>'raw',
            'attribute' => 'createdUserLink',
        ],
        [
            'class' => LinkColumn::class,
            'attribute' => 'order_id',
            'url' => function ($data) {
                return Url::to(['/jk/order/view','id'=>$data->order_id],true);
            },
        ],

        'receipt_at:datetime',
        [
            'attribute' => 'approval_at',
            'format'=>'raw',
            'value' => function($data){
                if ($data->approval_at){
                    return Yii::$app->formatter->asDatetime($data->approval_at);
                }else{
                    return Html::a(Icon::show('check').'Согласовать',Url::to(['/jk/agreement/check','id'=>$data->id],true),['class'=>'btn btn-block bg-gradient-primary btn-xs']);
                }
            },
        ],
        [
            'class' => SetColumn::class,
            'attribute' => 'approval',
            //'value' => 'approvalName',
            'name' => 'approvalName',
            'filter' => Agreement::getApprovalsArray(),
            'cssCLasses' => [
                Agreement::APPROVAL_WAIT => 'warning',
                Agreement::APPROVAL_YES => 'success',
                Agreement::APPROVAL_NO => 'danger',
            ],
        ],

        'comment',
    ],
]);
Pjax::end();