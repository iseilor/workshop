<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\nsi\models\Color */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
