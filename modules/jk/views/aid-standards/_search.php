<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\AidStandardsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aidstandards-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'income_bottom') ?>

    <?= $form->field($model, 'income_top') ?>

    <?= $form->field($model, 'compensation_years_zaim') ?>

    <?= $form->field($model, 'skp') ?>

    <?= $form->field($model, 'skp_young') ?>

    <?= $form->field($model, 'compensation_years_percent') ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
