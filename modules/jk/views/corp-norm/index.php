<?php

use app\components\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\CorpNormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\jk\Module::t('module', 'Corp Norm');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corpnorm-index">

    <p>
        <?= Html::a(\app\modules\jk\Module::t('module', 'Create Corp Norm'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number',
            'area',
            [
                'class' => ActionColumn::class,
                'visible' => Yii::$app->user->can('curator_mrf'),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
