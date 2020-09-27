<?php

use app\modules\kr\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('timetable', 'Timetables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timetable-index">



    <p>
        <?= Html::a(Yii::t('app', 'Create Timetable'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            'date',
            'title',
            'curator:ntext',
            //'description:ntext',
            //'img',
            'link',
            'weight',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
