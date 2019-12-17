<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\zhp\models\PercentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Percents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="percent-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Percent', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            //'date_birth',
            //'gender',
            //'experience',
            //'year',
            //'date_pension',
            //'family_count',
            //'family_income',
            //'area_total',
            //'area_buy',
            //'cost_total',
            //'cost_user',
            //'bank_credit',
            //'loan',
            //'percent_count',
            //'percent_rate',
            //'compensation_count',
            //'compensation_years',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
