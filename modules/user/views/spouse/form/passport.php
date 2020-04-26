<?php

use yii\jui\DatePicker;

?>
<?= $form->field($model, 'passport_series')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_date')->widget(
    DatePicker::class,
    [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => ['class' => 'form-control inputmask-date'],
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1950:2020',
            'changeYear' => true,
        ],
    ]
) ?>

<?= $form->field($model, 'passport_department')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_code')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'passport_registration')->textarea() ?>

<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>
