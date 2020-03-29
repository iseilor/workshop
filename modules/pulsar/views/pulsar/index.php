<?php

use app\modules\pulsar\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\pulsar\models\PulsarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'Pulsars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pulsar-index">

    <p>
        <?= Html::a(Module::t('module', 'Create Pulsar'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'created_by:user',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            'health_value',
            'mood_value',
            'job_value',
            //'health_comment',
            //'mood_comment',
            //'job_comment',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
