<?php

use yii\jui\DatePicker;

?>

<?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'placeholder' => 'Иванов Иван Иванович']) ?>
<?= $form->field($model, 'agreement_ppd')->checkbox(["template" =>
    "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"])
?>
<?=$form->field($model, 'gender',['options'=>['class'=>'d-none']])->dropDownList($model->getGenderList(), ['prompt' => 'Выберите ...']);?>
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
                                        passportYear = 1984;
                                        selected = new Date('1984-01-01');
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
    $('#child-fio').inputmask({regex: "[А-Яа-яёЁ \-]{1,255}"});
    
    arr = $('#child-date').val().split(".");
    var dateChild = new Date(arr[2],arr[1] - 1, arr[0]);
    var dateNow = new Date();
    var dateDiffYear = (dateNow-dateChild)/(1000 * 3600 * 24*365);
    requireShowedFields(dateDiffYear);
    
    $('#child-date').on('change', function() {
        
        // Разница между датами
        arr = $(this).val().split(".");
        var dateChild = new Date(arr[2],arr[1] - 1, arr[0]);
        var dateNow = new Date();
        var dateDiffYear = (dateNow-dateChild)/(1000 * 3600 * 24*365)
        
        requireShowedFields(dateDiffYear);
        // Паспорт
        if (dateDiffYear>=14){
            $('.passport-block').removeClass('d-none');
            $('.passport-block').addClass('required');
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
    function requireShowedFields(dateDiffYear) {
        var arr = new Map([
                      ['#child-passport_series', '.field-child-passport_series'],
                      ['#child-passport_number', '.field-child-passport_number'],
                      ['#child-passport_date', '.field-child-passport_date'],
                      ['#child-passport_department', '.field-child-passport_department'],
                      ['#child-passport_code', '.field-child-passport_code'],
                      //['#child-passport_file_form', '.field-child-passport_file_form'],
                    ]);
        
        if (dateDiffYear>=14){
            $('.field-child-passport_file_form').addClass('required');
            if (!$('.field-child-passport_file_form label[for=exampleInputFile]').html()) {
                $('#child-passport_file_form').attr('required', true);
            }
            for (let pair of arr.entries()) {
              $(`\${pair[1]}`).addClass('required');
              $(`\${pair[0]}`).attr('required', true);
            }
        } else {
            $('#child-passport_file_form').attr('required', false);
            for (let pair of arr.entries()) {
              $(`\${pair[1]}`).removeClass('required');
              $(`\${pair[0]}`).attr('required', false);
            }
        }
    }
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
