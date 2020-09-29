<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('list').Module::t('timetable', 'Timetables');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">


        <p>
            <?= Html::a(Icon::show('plus') . Module::t('timetable', 'Create Timetable'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'block_id',
                'groups',
                //'description:ntext',
                //'img',
                'link',
                'weight',
                ['class' => \app\components\grid\ActionColumn::class],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>
