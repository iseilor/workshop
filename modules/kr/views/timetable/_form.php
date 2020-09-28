<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">

        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>


            </div>

            <div class="col-4">

                <?= $form->field($model, 'groups')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'curator')->textarea(['rows' => 3]) ?>
            </div>

            <div class="col-4">
                <?= $form->field($model, 'weight')->textInput() ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>

    </div>
    <?php ActiveForm::end(); ?>
</div>