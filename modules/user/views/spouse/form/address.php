<?php

use yii\helpers\Html;
?>

<div class="form-group">
    <?= Html::checkbox('temporary_registered', 0, ['label' => 'Наличие временной регистрации', 'id' => 'temporary_registered', 'style' => 'margin-top: 1rem;',
        'checked' => ($model->registration_file) ? true:false]) ?>
</div>

<?= $form->field($model, 'passport_registration')
    ->textarea([
        'readonly' => $model->passport_registration == $user->passport_registration,
        'data-user-address-registration' => $user->passport_registration,
    ])
    ->hint($model->attributeHints()['passport_registration']) ?>

<?= $form->field($model, 'registration_file_form', [
    'options' => ['class' => (!$model->registration_file) ? 'd-none':''],
    'template' => getFileInputTemplate($model->registration_file, $model->attributeLabels()['registration_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?= $form->field($model, 'edj_file_form', [
    'options' => ['class' => (!$model->edj_file) ? 'd-none':''],
    'template' => getFileInputTemplate($model->edj_file, $model->attributeLabels()['edj_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#temporary_registered').on('change', function() {
        $('.field-spouse-registration_file_form').toggleClass('d-none');
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
