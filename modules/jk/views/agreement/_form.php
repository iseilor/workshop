<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Agreement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="agreement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id')->textInput() ?>
    <?= $form->field($model, 'user_id')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'receipt_at')->textInput() ?>
    <?= $form->field($model, 'approval_at')->textInput() ?>
    <?= $form->field($model, 'is_approval')->textInput() ?>
    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
