<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\AidStandards */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aidstandards-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'income_bottom')->textInput() ?>

    <?= $form->field($model, 'income_top')->textInput() ?>

    <?= $form->field($model, 'compensation_years_zaim')->textInput() ?>

    <?= $form->field($model, 'skp')->textInput() ?>

    <?= $form->field($model, 'skp_young')->textInput() ?>

    <?= $form->field($model, 'compensation_years_percent')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
