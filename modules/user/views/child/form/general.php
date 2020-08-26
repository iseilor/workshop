<?php

use yii\jui\DatePicker;

?>
<?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'placeholder' => 'Иванов Иван Иванович']) ?>
<!--$form->field($model, 'gender')->dropDownList($model->getGenderList(), ['prompt' => 'Выберите ...']);-->
<?= $form->field($model, 'date')->widget(
    DatePicker::class,
    [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => ['class' => 'form-control inputmask-date'],
        'clientOptions' => [
            'onClose' => new \yii\web\JsExpression("
                                function(dateText, inst) {
                                    now = new Date();
                                    birth = $('#child-date').val();
                                    
                                    if (birth != '') {
                                        arr = birth.split('.');
                                        birthYear = arr[2];
                                        passportYear = +arr[2] + 14;
                                        selected = new Date(arr[2],arr[1] - 1, arr[0]);
                                    } else {
                                        birthYear = 1970;
                                    }
                                    
                                    $('#child-birth_date').datepicker('option', 'yearRange', `\${birthYear}:\${now.getFullYear()}`);
                                    $('#child-passport_date').datepicker('option', 'yearRange', `\${passportYear}:\${now.getFullYear()}`);
                                        
                                    if (selected.getTime() > now) {
                                        $('#child-date' ).datepicker( 'setDate', now );
                                    }
                                }"),
            'changeMonth' => true,
            'yearRange' => '1997:2020', // Не старше 23 лет
            'changeYear' => true,
        ],
    ]
) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#child-fio').inputmask({regex: "[А-Яа-я \-]{1,255}"});
    $('#child-date').on('change', function() {
        
        // Разница между датами
        arr = $(this).val().split(".");
        var dateChild = new Date(arr[2],arr[1] - 1, arr[0]);
        var dateNow = new Date();
        var dateDiffYear = (dateNow-dateChild)/(1000 * 3600 * 24*365)
        
        // Паспорт
        if (dateDiffYear>=14){
            $('.passport-block').removeClass('d-none');
            $('#child-passport_series').attr('aria-required', true);
        }else{
            $('.passport-block').addClass('d-none');
        }

        // Студент и инвалид
         if (dateDiffYear>=18){
            $('.study-block,.invalid-block').removeClass('d-none');
        }else{
            $('.study-block,.invalid-block').addClass('d-none');
        }
       
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
