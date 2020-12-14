<?php

use app\modules\jk\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\ZaimTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('zaim_type', 'Zaim Types');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jk-zaim-type-index">

    <p>
        <?= Html::a(Module::t('zaim_type', 'Create Zaim Type'), ['create'], ['class' => 'btn btn-success']) ?>
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
            [
                'label' => Yii::t('app','Created By'),
                'attribute' => 'created_by',
                'value' => 'createdUser.fio',
            ],
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            'title',
            'description',
            ['class' => 'yii\grid\ActionColumn',
             'visible' => Yii::$app->user->can('curator_rf')],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
