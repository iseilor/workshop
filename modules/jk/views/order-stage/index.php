<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\OrderStageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Stages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'order_id',
                    'status_id',
                    'created_at:datetime',
                    'created_by',
                    //'updated_at',
                    //'updated_by',
                    //'deleted_at',
                    //'deleted_by',
                    'comment',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]
        ); ?>
    </div>
</div>
