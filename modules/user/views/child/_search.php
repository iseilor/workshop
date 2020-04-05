<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\ChildSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-search">

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

    <?php // echo $form->field($model, 'file_passport') ?>

    <?php // echo $form->field($model, 'file_registration') ?>

    <?php // echo $form->field($model, 'file_birth') ?>

    <?php // echo $form->field($model, 'file_address') ?>

    <?php // echo $form->field($model, 'file_ejd') ?>

    <?php // echo $form->field($model, 'file_personal') ?>

    <?php // echo $form->field($model, 'is_invalid') ?>

    <?php // echo $form->field($model, 'file_invalid') ?>

    <?php // echo $form->field($model, 'file_posobie') ?>

    <?php // echo $form->field($model, 'is_study') ?>

    <?php // echo $form->field($model, 'file_study') ?>

    <?php // echo $form->field($model, 'file_scholarship') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
