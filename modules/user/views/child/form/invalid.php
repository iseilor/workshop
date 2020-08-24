<?= $form->field($model, 'is_invalid')->checkbox()->hint($model->getAttributeHint('is_invalid')) ?>

<?= $form->field($model, 'file_invalid_form', [
    'options' => ['class' => (!$model->is_invalid) ? 'd-none':''],
    'template' => getFileInputTemplate($model->file_invalid, $model->attributeLabels()['file_invalid'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>
<!--$form->field($model, 'file_posobie_form', [
    'options' => ['class' => (!$model->is_invalid) ? 'd-none':''],
    'template' => getFileInputTemplate($model->file_posobie, $model->attributeLabels()['file_posobie'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])-->

<?php
$script = <<< JS
$(document).ready(function() {
    $('#child-is_invalid').on('click', function() {
        $('.field-child-file_invalid_form,.field-child-file_posobie_form').toggleClass('d-none');
        if (!$('.field-child-file_invalid_form').hasClass('d-none')) {
            $('#child-file_invalid_form').attr('required', true);
        } else {
            $('#child-file_invalid_form').attr('required', false);
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>