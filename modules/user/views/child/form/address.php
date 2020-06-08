<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= $form->field($model, 'address_registration')
    ->textarea([
        'readonly' => $model->address_registration == $user->passport_registration,
        'data-user-address-registration'=>$user->passport_registration
    ])
    ->hint($model->attributeHints()['address_registration'] . '<br/>' .
        Html::checkbox('user_address_registration',
            $model->address_registration == $user->passport_registration,
            ['label' => 'Совпадает с адресом регистрации сотрудника', 'id' => 'user_address_registration'])
    ) ?>
<?= $form->field($model, 'registration_file_form', [
    'template' => getFileInputTemplate($model->registration_file,  'Свидетельство о регистрации.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>


<?= $form->field($model, 'address_fact')
    ->textarea([
        'readonly' => $model->address_fact == $user->address_fact,
        'data-user-address-fact'=>$user->address_fact

    ])
    ->hint($model->attributeHints()['address_fact'] . '<br/>' .
        Html::checkbox('user_address_fact',
            $model->address_fact == $user->address_fact,
            ['label' => 'Совпадает с адресом фактического проживания сотрудника', 'id' => 'user_address_fact'])
    ) ?>


<?= $form->field($model, 'address_mother_file_form', [
    'template' => getFileInputTemplate($model->address_mother_file,  'Заявление от матери.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR])
        . 'Образец заявления', Url::base().Url::to('/files/child/0-examples/example_child_address_mother.pdf'), ['target' => '_blank'])) ?>

<?= $form->field($model, 'address_father_file_form', [
    'template' => getFileInputTemplate($model->address_father_file, 'Заявление от отца.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. 
    Если в свидетельстве у ребёнка не указан отец, то заявление от папы не нужно. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR]) . 'Образец заявления', Url::base().Url::to('/files/child/0-examples/example_child_address_father.pdf'), ['target' => '_blank'])) ?>

<?= $form->field($model, 'ejd_file_form', [
    'template' => getFileInputTemplate($model->ejd_file, $model->attributeLabels()['ejd_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('ejd_file_form')) ?>


<?php
$script = <<< JS
$(document).ready(function() {
   
    // Адрес регистрации ребёнка совпадает с адресом регистарции сотрудника
    $('#user_address_registration').on('click', function() {
        if($(this).prop("checked")) {
            $('#child-address_registration').prop( "readonly", true );
            $('#child-address_registration').val($('#child-address_registration').data('user-address-registration'));
        }else{
            $('#child-address_registration').prop( "readonly", false );
       }
    });
    
     // Адрес фактического проживание ребёнка совпадает с адресом фактичекого проживания сотрудника
    $('#user_address_fact').on('click', function() {
        if($(this).prop("checked")) {
            $('#child-address_fact').prop( "readonly", true );
            $('#child-address_fact').val($('#child-address_fact').data('user-address-fact'));
        }else{
            $('#child-address_fact').prop( "readonly", false );
       }
    });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>