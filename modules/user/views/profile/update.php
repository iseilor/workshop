<?php

use app\modules\user\Module;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'Profile Update');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Profile Update'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><?= $this->title; ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birth_date')->widget(DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'dd.MM.yyyy',
            'options' => ['class' => 'form-control'],
        ]) ?>
        <?= $form->field($model, 'gender')->dropDownList(
            [
                '1' => 'М',
                '0' => 'Ж',
            ]
        ); ?>
        <?= $form->field($model, 'work_date')->widget(DatePicker::classname(), [
            'language' => 'ru',
            'dateFormat' => 'dd.MM.yyyy',
            'options' => ['class' => 'form-control'],
        ]) ?>
    </div>
    <div class="card-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>