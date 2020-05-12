<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk']];
$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => "<i class='fas fa-calculator nav-icon'></i> " . Module::t('module', 'Percents'), 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="percent-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(
            Yii::t('app', 'Delete'),
            ['delete', 'id' => $model->id],
            [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]
        ) ?>
    </p>

    <?= DetailView::widget(
        [
            'model' => $model,

            'attributes' => [
                'id',
                //'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',
                'date_birth:date',
                [
                    'attribute' => 'gender',
                    'value' => ($model->gender == 1 ? 'Мужской' : 'Женский'),
                ],
                'experience',
                'family_count',
                'family_income:integer',
                'area_total:decimal',
                'area_buy:decimal',
                'cost_total:integer',
                'cost_user:integer',
                'bank_credit:integer',
                [
                    'attribute' => 'loan',
                    'visible' => false,
                ],
                'percent_count:integer',
                'percent_rate:decimal',
                //'compensation_result',
                [
                    'attribute' => 'compensation_count',
                    'format'=>'integer',
                    'contentOptions' => ['class' => 'table-success']
                ],
                [
                    'attribute' => 'compensation_years',
                    'contentOptions' => ['class' => 'table-success']
                ]
            ],
        ]
    ) ?>

</div>
