<?php

use app\components\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\RetirementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\admin\Module::t('module', 'Retirement');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrf-index">

    <p>
        <?= Html::a(\app\modules\admin\Module::t('module', 'Create Retirement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'age',
            'gender',
            ['class' => ActionColumn::className()],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
