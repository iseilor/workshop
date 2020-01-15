<?php

use app\modules\user\Module;

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = '<i class="fas fa-user-edit"></i> '.Module::t('module', 'Profile Update');
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-user"></i> '.Module::t('module', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home">
                    <i class="fas fa-user"></i> Общие данные</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                   aria-selected="true">
                    <i class="far fa-address-card"></i> Паспорт
                </a>
            </li>
        </ul>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
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
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">

            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>