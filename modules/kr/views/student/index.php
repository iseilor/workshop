<?php

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
$this->params['breadcrumbs'][] = ['label' => Icon::show('users') . Module::t('module', 'kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>

    <div class="card-body">

        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => [
                'class' => 'table table-striped projects',
                'style' => 'margin-bottom: 0'
            ],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'user.photoFioLabel:html',
                'total',
                [
                    'filter' => ArrayHelper::map(Block::find()->all(), 'id', 'title'),
                    'attribute' => 'blockTitle',
                    'value' => 'block.badge',
                    'format' => 'html',
                ],
                'created_at:date'
            ],
        ]); ?>

        <?php Pjax::end(); ?>

    </div>
</div>