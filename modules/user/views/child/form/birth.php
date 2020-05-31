<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>
<?= $form->field($model, 'birth_series')->widget(MaskedInput::class, [
    'mask' => 'A-AA',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'birth_number')->widget(MaskedInput::class, [
    'mask' => '999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
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
<?= $form->field($model, 'birth_department')->textarea(['maxlength' => true]) ?>
<?= $form->field($model, 'birth_code')->widget(MaskedInput::class, [
    'mask' => '99999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'birth_file_form', [
    'template' => getFileInputTemplate($model->birth_file, $model->attributeLabels()['birth_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>