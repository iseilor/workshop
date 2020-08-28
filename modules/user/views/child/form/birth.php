<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Html;

?>
<div class="form-group">
    <?= Html::checkbox('foreigner', 0, ['label' => 'Иностранец', 'id' => 'foreigner-address', 'style' => 'margin-top: 1rem;']) ?>
</div>
<?= $form->field($model, 'birth_series')->widget(MaskedInput::class, [
    'mask' => 'a{1,3}-aa',
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
<?php
$fromInYears = date("Y", 1);
$toInYears = date("Y");
?>
<?= $form->field($model, 'birth_date')->widget(
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
                                        birth = new Date(arr[2],arr[1] - 1, arr[0]);
                                    } else {
                                        birth = new Date('1970-01-01');
                                    }
                                    
                                    if (dateText != '') {
                                        arr = dateText.split('.');
                                        selected = new Date(arr[2],arr[1] - 1, arr[0]);
                                    } else {
                                        selected = new Date();
                                    }
                                    
                                    if (selected.getTime() > now) {
                                        $('#child-birth_date' ).datepicker( 'setDate', now );
                                    } else if (selected.getTime() < birth) {
                                        $('#child-birth_date' ).datepicker( 'setDate', birth );
                                    }
                                 }"),
            'changeMonth' => true,
            'yearRange' => "$fromInYears:$toInYears", // Не старше 23 лет
            'changeYear' => true,
        ],
    ]
) ?>
<?= $form->field($model, 'birth_department')->textarea(['maxlength' => true, 'placeholder' => 'Измайловский отдел ЗАГС Управления ЗАГС Москвы']) ?>
<!--$form->field($model, 'birth_code')->widget(MaskedInput::class, [
    'mask' => '99999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
])-->
<?= $form->field($model, 'birth_file_form', [
    'template' => getFileInputTemplate($model->birth_file, $model->attributeLabels()['birth_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('.field-child-birth_file_form').addClass('required');
    $('#child-birth_file_form').attr('required', true);
    
    $('#foreigner-address').on('change', function() {
        console.log($('#foreigner-address').prop('checked'));
        if ($('#foreigner-address').prop('checked') == true) {
            $('#child-birth_series').inputmask({ mask: ""});
            $('#child-birth_number').inputmask({ mask: ""});
            $('#child-birth_code').inputmask({ mask: ""});
            
            $('#child-passport_series').inputmask({ mask: ""});
            $('#child-passport_number').inputmask({ mask: ""});
            $('#child-passport_code').inputmask({ mask: ""});
        } else {
            $('#child-birth_series').inputmask({ mask: "a{1,3}-aa"});
            $('#child-birth_number').inputmask({ mask: "999999"});
            $('#child-birth_code').inputmask({ mask: "99999999"});
            
            $('#child-passport_series').inputmask({ mask: "9999"});
            $('#child-passport_number').inputmask({ mask: "999999"});
            $('#child-passport_code').inputmask({ mask: "999-999"});
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
