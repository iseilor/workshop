<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;

use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\PercentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('wallet').Module::t('module', 'Zaims');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').'Жилищная Программа', 'url' => ['/jk']];
$this->params['breadcrumbs'][] =['label' => Icon::show('tools').'Админка', 'url' => ['/jk/admin']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card  card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'tableOptions' => [
                        'class' => 'table table-striped projects table-bordered',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        [
                            'class' => LinkColumn::class,
                            'attribute' => 'id',
                        ],
                        'created_at:datetime',
                        'createdUserLabel:html',

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
                        //'compensation_result',
                        'compensation_count:currency',
                        'compensation_years',

                        [
                            'class' => ActionColumn::class,
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>