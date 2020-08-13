<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>

    <div class="row">
        <div class="row-12">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Информация</h5>
                Данные поля не обязательны для заполнения при работе с большинством услуг на портале. Но их
                нужно будет заполнить, например, если вы подаёте заявку для участия в жилищной программе
            </div>
        </div>
        <div class="col-md-4">
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
                        'autoclose' => true,
                        'yearRange' => '1950:2020',
                        'clearIncomplete' => true,
                        'changeYear' => true,
                    ],
                ]
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'passport_department')->textarea() ?>
            <?= $form->field($model, 'passport_code')->widget(MaskedInput::class, [
                'mask' => '999-999',
                'clientOptions' => [
                    'clearIncomplete' => true,
                ],
            ]) ?>
            <?= $form->field($model, 'passport_file', [
                'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'passport_registration')->textarea()->hint($model->attributeHints()['passport_registration']); ?>
            <?= $form->field($model, 'address_fact')
                ->textarea(['readonly' => ($model->passport_registration == $model->address_fact) ? true : false])
                ->hint($model->attributeHints()['address_fact'] . '<br/>' .
                    Html::checkbox('Совпадает с адресом регистрации',
                        ($model->passport_registration == $model->address_fact) ? true : false,
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