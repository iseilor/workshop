<?php

use yii\helpers\Html;
use yii\jui\DatePicker;

?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'passport_series')->textInput() ?>
            <?= $form->field($model, 'passport_number')->textInput() ?>
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
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'passport_department')->textarea() ?>
            <?= $form->field($model, 'passport_code')->textInput() ?>
            <?= $form->field($model, 'passport_file', [
                'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'passport_registration')->textarea()->hint($model->attributeHints()['passport_registration']); ?>
            <?= $form->field($model, 'address_fact')
                ->textarea(['readonly'=>($model->passport_registration==$model->address_fact)?true:false])
                ->hint($model->attributeHints()['address_fact'] . '<br/>' .
                Html::checkbox('Совпадает с адресом регистрации',
                    ($model->passport_registration==$model->address_fact)?true:false,
                    ['label' => 'Совпадает с адресом регистрации', 'id' => 'address_fact_check'])
            ) ?>
        </div>
    </div>

<?php
$script = <<< JS
$(document).ready(function() {
    // Адрес фактического проживание совпадает с адресом регистарции
    $('#address_fact_check').on('click', function() {
        if($(this).prop("checked")) {
            $('#profileupdateform-address_fact').prop( "readonly", true );
            $('#profileupdateform-address_fact').val($('#profileupdateform-passport_registration').val());
        }else{
            $('#profileupdateform-address_fact').prop( "readonly", false );
       }
    });
    
    // Изменения в адресе регистарции => изменения в фактическом адресе
    $('#profileupdateform-passport_registration').on('keyup', function() {
        if($('#address_fact_check').prop("checked")) {
            $('#profileupdateform-address_fact').val($('#profileupdateform-passport_registration').val());
        }
    });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>