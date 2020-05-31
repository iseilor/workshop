<?php

use yii\helpers\Html;
use yii\jui\DatePicker;

/***
 * @var $model \app\modules\user\models\Spouse
 */

?>
<?= $form->field($model, 'passport_series')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_number')->textInput(['maxlength' => true]) ?>

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

<?= $form->field($model, 'passport_department')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_code')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'passport_registration')
    ->textarea([
        'readonly' => $model->passport_registration == $user->passport_registration,
        'data-user-address-registration' => $user->passport_registration,
    ])
    ->hint($model->attributeHints()['passport_registration'] . '<br/>' .
        Html::checkbox('user_address_registration',
            $model->passport_registration == $user->passport_registration,
            ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_registration'])
    ) ?>

<?= $form->field($model, 'address_fact')
    ->textarea([
        'readonly' => $model->address_fact == $user->address_fact,
        'data-user-address-fact' => $user->address_fact,
    ])
    ->hint($model->attributeHints()['address_fact'] . '<br/>' .
        Html::checkbox('user_address_registration',
            $model->address_fact == $user->address_fact,
            ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_fact'])
    ) ?>


<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
   
    // Адрес регистрации супруги совпадает с адресом регистарции сотрудника
    $('#user_address_registration').on('click', function() {
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
