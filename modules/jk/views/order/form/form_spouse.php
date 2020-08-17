<?php

use app\modules\user\models\Spouse;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

echo $this->render('@app/modules/user/views/spouse/info');

?>
<div class="row">
    <div class="col-lg-4">
        <?= $form->field($spose, 'type')->dropDownList(Spouse::getTypeList()); ?>
    </div>

    <div class="col-lg-4">


    </div>

    <div class="col-lg-4">


    </div>

</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="type-1 type-2">
                <?= $form->field($spose, 'fio')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="type-1 type-2">
                <?= $form->field($spose, 'gender')->dropDownList($spose->getGenderList(), ['prompt' => 'Выберите ...']); ?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="type-1 type-2">
                <?= $form->field($spose, 'marriage_file_form', [
                'template' => getFileInputTemplate($spose->marriage_file,  'Копия.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>

    </div>



    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($spose, 'passport_series')->widget(MaskedInput::class, [
                'mask' => '9999',
                'clientOptions' => [
                    'clearIncomplete' => true,
                ],
            ]) ?>
            <?= $form->field($spose, 'passport_department')->textarea(['maxlength' => true]) ?>
            <?= $form->field($spose, 'address_fact')
                ->textarea([
                    'readonly' => $spose->address_fact == $usermd->address_fact,
                    'data-user-address-fact' => $usermd->address_fact,
                ])
                ->hint($spose->attributeHints()['address_fact'] . '<br/>' .
                    Html::checkbox('user_address_registration',
                        $spose->address_fact == $usermd->address_fact,
                        ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_fact'])
                ) ?>
        </div>

    <div class="col-lg-4">
        <?= $form->field($spose, 'passport_number')->widget(MaskedInput::class, [
            'mask' => '999999',
            'clientOptions' => [
                'clearIncomplete' => true,
            ],
        ]) ?>
        <?= $form->field($spose, 'passport_code')->widget(MaskedInput::class, [
            'mask' => '999-999',
            'clientOptions' => [
                'clearIncomplete' => true,
            ],
        ]) ?>
        <?= $form->field($spose, 'passport_file_form', [
            'template' => getFileInputTemplate($spose->passport_file, $spose->attributeLabels()['passport_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-lg-4">
        <?= $form->field($spose, 'passport_date')->widget(
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

        <?= $form->field($spose, 'passport_registration')
            ->textarea([
                'readonly' => $spose->passport_registration == $usermd->passport_registration,
                'data-user-address-registration' => $usermd->passport_registration,
            ])
            ->hint($spose->attributeHints()['passport_registration'] . '<br/>' .
                Html::checkbox('user_address_registration',
                    $spose->passport_registration == $usermd->passport_registration,
                    ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_registration_to_spouse_ra'])
            ) ?>


    </div>











    </div>























<?php
$script = <<< JS
$(document).ready(function() {
    $('#spouse-type').on('change', function() {
        switch ($(this).val()) {
          case '0':
                $('.type-1,.type-2').addClass('d-none');
                break;
          case '1':
                $('.type-1').removeClass('d-none');
                break;
          case '2':
              $('.type-1').addClass('d-none');
              $('.type-2').removeClass('d-none');
            break;
        }
    });
    
    
    
    
    // Адрес фактического проживание супруги совпадает с адресом фактичекого проживания сотрудника
    // $('#passport_address_fact').on('click', function() {
    //     if($(this).prop("checked")) {
    //         $('#passport-address_fact').prop( "readonly", true );
    //         $('#passport-address_fact').val($('#passport-passport_registration').val());
    //     }else{
    //         $('#passport-address_fact').prop( "readonly", false );
    //    }
    // });
    //
    // Адрес фактического проживание супруги совпадает с адресом фактичекого проживания сотрудника
    $('#user_address_registration_to_spouse_ra').on('click', function() {
        if($(this).prop("checked")) {
    //         $('#passport-address_fact').prop( "readonly", true );
    //         $('#passport-address_fact').val($('#passport-passport_registration').val());
        }else{
    //         $('#passport-address_fact').prop( "readonly", false );
       }
    });
    
    
    
    
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>