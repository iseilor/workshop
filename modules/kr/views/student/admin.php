<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\kr\models\Block;
use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('users') . Module::t('student', 'Students');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').Module::t('module','admin'), 'url' => ['/kr/admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>

    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pager' => [
                'class' => 'app\widgets\LinkPager',
            ],
            'tableOptions' => [
                'class' => 'table table-striped projects',
                'style' => 'margin-bottom: 0'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'created_by',
                //'deleted_at',
                //'deleted_by',
                'user.photoFioLabel:html',
                [
                    'filter' => ArrayHelper::map(Block::find()->published()->all(), 'id', 'title'),
                    'attribute' => 'blockTitle',
                    'value' => 'block.badge',
                    'format' => 'html',
                ],
                'total',
                'created_at:datetime',
                'updated_at:datetime',
                'updatedUserLink:html',
                //'description:ntext',
                //'weight',

                ['class' => ActionColumn::class],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>