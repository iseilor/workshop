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
            'onClose' => new \yii\web\JsExpression("
                                function(dateText, inst) {
                                    birth = $('#child-date').val();
                                    now = new Date();
                                    
                                    if (birth != '') {
                                        arr = birth.split('.');
                                        passport = new Date(+arr[2] + 14,arr[1] - 1, arr[0]);
                                    } else {
                                        passport = new Date('1997-01-01');
                                    }
                                    
                                    if (dateText != '') {
                                        arr = dateText.split('.');
                                        selected = new Date(arr[2],arr[1] - 1, arr[0]);
                                    } else {
                                        selected = new Date();
                                    }
                                    
                                    if (selected.getTime() > now.getTime()) {
                                        $('#child-passport_date' ).datepicker( 'setDate', now );
                                    } else if (selected.getTime() < passport.getTime()) {
                                        $('#child-passport_date' ).datepicker( 'setDate', passport );
                                    }
                                 }"),
            'changeMonth' => true,
            'yearRange' => '1997:2020',
            'changeYear' => true,
        ],
    ]
) ?>
<!-- $form->field($model, 'passport_address')->textarea() -->
<?= $form->field($model, 'passport_department')->textarea() ?>
<?= $form->field($model, 'passport_code')->widget(MaskedInput::class, [
    'mask' => '999-999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Необходимо отсканировать все страницы паспорта (включая пустые)')?>