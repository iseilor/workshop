<?php

use app\modules\main\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '<i class="fas fa-users"></i>'.' '.Module::t('module', 'Teams');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="team-index">

    <p>
        <?= Html::a(Module::t('module', 'Create Team'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'full_name',
            'filial',
            'email:email',
            'phone',
            'position',
            'birth',

            //'department',
            //'city',
            //'photo',
            //'about:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
