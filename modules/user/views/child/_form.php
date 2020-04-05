<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-8">
                        <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'gender')->dropDownList($model->getGenderList(), ['prompt' => 'Выберите ...']); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, 'date')->widget(
                            DatePicker::classname(),
                            [
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control inputmask-date'],
                                'clientOptions' => [
                                    'changeMonth' => true,
                                    //'yearRange' => '2000:2050',
                                    'changeYear' => true,
                                ],
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'file_passport_form', [
                            'template' => getFileInputTemplate($model->file_passport, $model->attributeLabels()['file_passport'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                        <?= $form->field($model, 'file_personal_form', [
                            'template' => getFileInputTemplate($model->file_personal, $model->attributeLabels()['file_personal'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'file_registration_form', [
                            'template' => getFileInputTemplate($model->file_registration, $model->attributeLabels()['file_registration'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                        <?= $form->field($model, 'file_address_form', [
                            'template' => getFileInputTemplate($model->file_address, $model->attributeLabels()['file_address'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'file_birth_form', [
                            'template' => getFileInputTemplate($model->file_birth, $model->attributeLabels()['file_birth'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                        <?= $form->field($model, 'file_ejd_form', [
                            'template' => getFileInputTemplate($model->file_ejd, $model->attributeLabels()['file_ejd'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>

                    <div class="col-md-4">
                        <?= $form->field($model, 'is_invalid')->checkbox() ?>
                        <?= $form->field($model, 'file_invalid_form', [
                            'template' => getFileInputTemplate($model->file_invalid, $model->attributeLabels()['file_invalid'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                        <?= $form->field($model, 'file_posobie_form', [
                            'template' => getFileInputTemplate($model->file_posobie, $model->attributeLabels()['file_posobie'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>


                    <div class="col-md-4">
                        <?= $form->field($model, 'is_study')->checkbox() ?>
                        <?= $form->field($model, 'file_study_form', [
                            'template' => getFileInputTemplate($model->file_study, $model->attributeLabels()['file_study'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                        <?= $form->field($model, 'file_scholarship_form', [
                            'template' => getFileInputTemplate($model->file_scholarship, $model->attributeLabels()['file_scholarship'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
