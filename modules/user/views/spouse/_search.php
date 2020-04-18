<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\SpouseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="spouse-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'fio') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'passport_series') ?>

    <?php // echo $form->field($model, 'passport_number') ?>

    <?php // echo $form->field($model, 'passport_date') ?>

    <?php // echo $form->field($model, 'passport_department') ?>

    <?php // echo $form->field($model, 'passport_code') ?>

    <?php // echo $form->field($model, 'passport_file') ?>

    <?php // echo $form->field($model, 'agree_personal_data') ?>

    <?php // echo $form->field($model, 'agree_personal_data_file') ?>

    <?php // echo $form->field($model, 'edj') ?>

    <?php // echo $form->field($model, 'edj_file') ?>

    <?php // echo $form->field($model, 'spouse_is_work') ?>

    <?php // echo $form->field($model, 'spouse_is_rtk') ?>

    <?php // echo $form->field($model, 'spouse_is_do') ?>

    <?php // echo $form->field($model, 'marriage_file') ?>

    <?php // echo $form->field($model, 'registration_file') ?>

    <?php // echo $form->field($model, 'explanatory_note_file') ?>

    <?php // echo $form->field($model, 'work_file') ?>

    <?php // echo $form->field($model, 'unemployment_file') ?>

    <?php // echo $form->field($model, 'salary_file') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
