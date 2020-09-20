<?php

use app\components\grid\ActionColumn;
use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\BlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blocks');


$this->title = Icon::show('cubes') . Module::t('block', 'Blocks');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users') . Module::t('module', 'kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools') . Module::t('module', 'admin'), 'url' => ['/kr/admin/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>
    <div class="card-body">

        <p>
            <?= Html::a(Icon::show('plus') . Module::t('block', 'Create Block'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'badge:html',
                'subtitle',
                'code',
                //'description:ntext',
                //'img',
                //'icon',
                //'color',
                'created_at:datetime',
                'createdUserLink:html',
                'updated_at:datetime',
                'updatedUserLink:html',
                'weight',

                ['class' => ActionColumn::class],
            ],
        ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>