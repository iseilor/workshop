<?php

use app\components\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\AidStandardsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\modules\jk\Module::t('module', 'Aid Standards');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corpnorm-index">

    <p>
        <?= Html::a(\app\modules\jk\Module::t('module', 'Create Aid Standards'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'income_bottom',
            'income_top',
            'compensation_years_zaim',
            'skp',
            'skp_young',
            'compensation_years_percent',
            [
                'class' => ActionColumn::class,
                'visible' => Yii::$app->user->can('curator_rf'),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
