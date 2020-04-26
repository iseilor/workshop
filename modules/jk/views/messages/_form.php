<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Messages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="messages-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>