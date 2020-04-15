<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'passport_series')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_date')->textInput() ?>

    <?= $form->field($model, 'passport_department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agree_personal_data')->textInput() ?>

    <?= $form->field($model, 'agree_personal_data_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edj')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edj_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_work')->textInput() ?>

    <?= $form->field($model, 'is_rtk')->textInput() ?>

    <?= $form->field($model, 'is_do')->textInput() ?>

    <?= $form->field($model, 'marriage_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'explanatory_note_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unemployment_file')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary_file')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
