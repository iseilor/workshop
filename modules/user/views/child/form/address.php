<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

if ($spouse->id == null) {
    $items = [
        0 => 'Не совпадает',
        1 => 'Работника',
    ];
    $spouse_ar = '';
} else {
    $items = [
        0 => 'Не совпадает',
        1 => 'Работника',
        2 => 'Супруги(а)'
    ];
    $spouse_ar = $spouse->passport_registration;
}

$params = [
    'required' => true,
    'class' => 'form-control',
    'prompt' => 'Выберите вариант...',
    'id' => 'address-matched'
]; ?>

<?= '<div class="form-group required", style="margin-bottom: 1rem;">'?>
<?= Html::label('Адрес регистрации ребёнка совпадает с адресом регистрации:', 'address-matched') ?>
<?= Html::dropDownList('matches',null, $items, $params) ?>
<?= '</div>'?>

<?= $form->field($model, 'address_registration')
    ->textarea([
        /*'readonly' => $model->address_registration == $user->passport_registration,*/
        'data-user-address-registration'=>$user->passport_registration,
        'data-spouse-address-registration'=>$spouse_ar
    ])
    ->hint($model->attributeHints()['address_registration'] . '<br/>'/* .
        Html::checkbox('user_address_registration',
            $model->address_registration == $user->passport_registration,
            ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_registration'])*/
    ) ?>
<?= $form->field($model, 'registration_file_form', [
    'template' => getFileInputTemplate($model->registration_file,  'Свидетельство о регистрации.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Вкладывается свидетельство о регистрации по месту жительства, при временной прописке - документ о временной регистрации.') ?>


<!--$form->field($model, 'address_fact')
    ->textarea([
        'readonly' => $model->address_fact == $user->address_fact,
        'data-user-address-fact'=>$user->address_fact

    ])
    ->hint($model->attributeHints()['address_fact'] . '<br/>' .
        Html::checkbox('user_address_fact',
            $model->address_fact == $user->address_fact,
            ['label' => 'Совпадает с адресом фактического проживания сотрудника', 'id' => 'user_address_fact'])
    )-->


<?= $form->field($model, 'address_mother_file_form', [
    'template' => getFileInputTemplate($model->address_mother_file,  'Заявление от матери.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR])
        . 'Образец заявления', Url::base().Url::to('/files/child/0-examples/example_address_child.docx'), ['target' => '_blank'])) ?>

<?= $form->field($model, 'address_father_file_form', [
    'template' => getFileInputTemplate($model->address_father_file, 'Заявление от отца.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. 
    Если в свидетельстве у ребёнка не указан отец, то заявление от папы не нужно. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR]) . 'Образец заявления', Url::base().Url::to('/files/child/0-examples/example_address_child.docx'), ['target' => '_blank'])) ?>

<?= $form->field($model, 'ejd_file_form', [
    'template' => getFileInputTemplate($model->ejd_file, $model->attributeLabels()['ejd_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('ejd_file_form')) ?>


<?php
$script = <<< JS
$(document).ready(function() {
    $('.field-child-registration_file_form').addClass('required');
    $('#child-registration_file_form').attr('required', true);
    $('.field-child-registration_file_form').addClass('required');
    $('#child-registration_file_form').attr('required', true);
    $('.field-child-address_mother_file_form').addClass('required');
    $('#child-address_mother_file_form').attr('required', true);
    $('.field-child-address_father_file_form').addClass('required');
    $('#child-address_father_file_form').attr('required', true);
    
    $('#child-address_registration').val('');
    $('div.field-child-ejd_file_form').addClass('required');
    // Адрес регистрации ребёнка совпадает с адресом регистарции сотрудника или супруги(а)
    $('#address-matched').on('change', function() {
        if($('#address-matched').val() == 1) {
            if (!$('div.field-child-ejd_file_form').hasClass('d-none')) {
                $('div.field-child-ejd_file_form').addClass('d-none');
                $('#child-ejd_file_form').attr('required', false)
                $('div.field-child-ejd_file_form').removeClass('required');
            }
            $('#child-address_registration').prop( "readonly", true );
            $('#child-address_registration').val($('#child-address_registration').data('user-address-registration'));
        } else if ($('#address-matched').val() == 2){
            if (!$('div.field-child-ejd_file_form').hasClass('d-none')) {
                $('div.field-child-ejd_file_form').addClass('d-none');
                $('#child-ejd_file_form').attr('required', false)
                $('div.field-child-ejd_file_form').removeClass('required');
            }
            $('#child-address_registration').prop( "readonly", true );
            $('#child-address_registration').val($('#child-address_registration').data('spouse-address-registration'));
       } else {
            $('div.field-child-ejd_file_form').removeClass('d-none');
            $('#child-ejd_file_form').attr('required', true)
            $('div.field-child-ejd_file_form').addClass('required');
            
            $('#child-address_registration').val('');
            $('#child-address_registration').prop( "readonly", false );
       }
    });
    
     // Адрес фактического проживание ребёнка совпадает с адресом фактичекого проживания сотрудника
    /*$('#user_address_fact').on('click', function() {
        if($(this).prop("checked")) {
            $('#child-address_fact').prop( "readonly", true );
            $('#child-address_fact').val($('#child-address_fact').data('user-address-fact'));
        }else{
            $('#child-address_fact').prop( "readonly", false );
       }
    });*/
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>