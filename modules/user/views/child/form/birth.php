<?php

use yii\jui\DatePicker;

?>
<?= $form->field($model, 'birth_series')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_number')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_date')->widget(
    DatePicker::class,
    [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => ['class' => 'form-control inputmask-date'],
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1997:2020', // Не старше 23 лет
            'changeYear' => true,
        ],
    ]
) ?>
<?= $form->field($model, 'birth_department')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_code')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_address')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_file_form', [
    'template' => getFileInputTemplate($model->birth_file, $model->attributeLabels()['birth_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>