<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\zhp\models\PercentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="percent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'date_birth') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'date_pension') ?>

    <?php // echo $form->field($model, 'family_count') ?>

    <?php // echo $form->field($model, 'family_income') ?>

    <?php // echo $form->field($model, 'area_total') ?>

    <?php // echo $form->field($model, 'area_buy') ?>

    <?php // echo $form->field($model, 'cost_total') ?>

    <?php // echo $form->field($model, 'cost_user') ?>

    <?php // echo $form->field($model, 'bank_credit') ?>

    <?php // echo $form->field($model, 'loan') ?>

    <?php // echo $form->field($model, 'percent_count') ?>

    <?php // echo $form->field($model, 'percent_rate') ?>

    <?php // echo $form->field($model, 'compensation_count') ?>

    <?php // echo $form->field($model, 'compensation_years') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
