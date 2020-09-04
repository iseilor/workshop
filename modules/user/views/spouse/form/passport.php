<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

/***
 * @var $model \app\modules\user\models\Spouse
 */

?>
<div class="form-group">
    <?= Html::checkbox('foreigner-passport', 0, ['label' => 'Иностранец', 'id' => 'foreigner-passport', 'style' => 'margin-top: 1rem;']) ?>
</div>
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

<?= $form->field($model, 'passport_department')->textarea(['maxlength' => true, 'placeholder' => 'МВД Тверского района, г.Москва']) ?>

<?= $form->field($model, 'passport_code')->widget(MaskedInput::class, [
    'mask' => '999-999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>

<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    var arr = [
                  '.field-spouse-passport_series',
                  '.field-spouse-passport_number',
                  '.field-spouse-passport_date',
                  '.field-spouse-passport_department',
                  '.field-spouse-passport_registration',
                  '.field-spouse-passport_code',
                  '.field-spouse-passport_file_form',
                ];
    arr.forEach(function(item, i, arr) {
      $(item).addClass('required');
    });
    
    $('#foreigner-passport').on('change', function() {
        if ($('#foreigner-passport').prop('checked') == true) {
            $('#spouse-passport_series').inputmask({ mask: ""});
            $('#spouse-passport_number').inputmask({ mask: ""});
            $('#spouse-passport_code').inputmask({ mask: ""});
        } else {
            $('#spouse-passport_series').inputmask({ mask: "9999"});
            $('#spouse-passport_number').inputmask({ mask: "999999"});
            $('#spouse-passport_code').inputmask({ mask: "999-999"});
        }
    });
    
    // Адрес регистрации супруги совпадает с адресом регистарции сотрудника
    $('label[for=spouse-passport_registration]').after('<br><input type="checkbox" id="spouse_fact_address" ' +
     'name="fact_address" value="1"> Совпадает с адресом регистрации работника');
    if ($('.field-spouse-edj_file_form').hasClass('d-none')) {
        $('#spouse_fact_address').attr('checked', true);
    } else {
        $('#spouse_fact_address').attr('checked', false);
    }
    $('#spouse_fact_address').on('change', function() {
        $('.field-spouse-edj_file_form').toggleClass('d-none');
        if($(this).prop("checked")) {
            $('#spouse-passport_registration').prop( "readonly", true );
            $('#spouse-passport_registration').val($('#spouse-passport_registration').data('user-address-registration'));
        }else{
            $('#spouse-passport_registration').prop( "readonly", false );
        }
    });
    
     // Адрес фактического проживание супруги совпадает с адресом фактичекого проживания сотрудника
    $('#user_address_fact').on('click', function() {
        if($(this).prop("checked")) {
            $('#spouse-address_fact').prop( "readonly", true );
            $('#spouse-address_fact').val($('#spouse-address_fact').data('user-address-fact'));
        }else{
            $('#spouse-address_fact').prop( "readonly", false );
       }
    });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
