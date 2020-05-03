<?php

use app\components\grid\ActionColumn;
use app\modules\jk\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'Order Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-status-index">

    <p>
        <?= Html::a(Module::t('module', 'Create Order Status'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at:datetime',
            'created_by',
            'title',
            'code',
            'progress',
            'color_id',
            //'description:ntext',

            [
                'class' => ActionColumn::class,
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
