<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$icon = '<i class="fas fa-user-plus"></i>';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=$icon?> <?= Html::encode($this->title) ?></h3>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="card-body">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton($icon.' '.$this->title, ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>