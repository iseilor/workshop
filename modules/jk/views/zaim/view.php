<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Zaims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="zaim-view">

    <p>
        <?= Html::a(Module::t('module', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('module', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('module', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'created_at:datetime',
            [
                'label' => Yii::t('app','Created By'),
                'value' => $model->createdUser->username,
            ],
            'updated_at:datetime',
            [
                'label' => Yii::t('app','Updated By'),
                'value' => $model->updatedUser->username,
            ],
            'deleted_at:datetime',
            [
                'label' => Yii::t('app','Deleted By'),
                'value' => ($model->deletedUser)?$model->deletedUser->username:'',
            ],

            'date_birth:date',
            'gender',
            'experience',
            'family_count',
            'family_income',
            'area_total',
            'area_buy',
            'cost_total',
            'cost_user',
            'bank_credit',
            'min.title',
            'compensation_result',
            'compensation_count',
            'compensation_years',
        ],
    ]) ?>

</div>
