<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>

<?= $form->field($model, 'passport_series')->widget(MaskedInput::class, [
    'mask' => '9999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>

<?= $form->field($model, 'passport_number')->widget(MaskedInput::class, [
    'mask' => '999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
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

<?= $form->field($model, 'passport_department')->textarea() ?>
<?= $form->field($model, 'passport_code')->widget(MaskedInput::class, [
    'mask' => '999-999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])?>
