<?php

use app\modules\project\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\project\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('task', 'Tasks');
$this->params['breadcrumbs'][] = ['label' => Module::t('project', 'Projects'), 'url' => ['/project']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-task-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Project Task'), ['create'], ['class' => 'btn btn-success']) ?>
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
            'project_id',
            'created_by',
            'comment:ntext',
            'status_id',
            'progress',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
