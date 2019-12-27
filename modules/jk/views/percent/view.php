<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Percents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="percent-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'date_birth',
            'gender',
            'experience',
            'family_count',
            'family_income',
            'area_total',
            'area_buy',
            'cost_total',
            'cost_user',
            'bank_credit',
            'loan',
            'percent_count',
            'percent_rate',
            'compensation_result',
            'compensation_count',
            'compensation_years',
        ],
    ]) ?>

</div>
