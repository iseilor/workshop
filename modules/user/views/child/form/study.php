<?= $form->field($model, 'is_study')->checkbox()->hint($model->attributeHints()['is_study']) ?>
<?= $form->field($model, 'file_study_form', [
    'options' => ['class' => (!$model->is_study) ? 'd-none':''],
    'template' => getFileInputTemplate($model->file_study, $model->attributeLabels()['file_study'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>
<!--$form->field($model, 'file_scholarship_form', [
    'options' => ['class' => (!$model->is_study) ? 'd-none':''],
    'template' => getFileInputTemplate($model->file_scholarship, $model->attributeLabels()['file_scholarship'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])-->

<?php
$script = <<< JS
$(document).ready(function() {
    $('#child-is_study').on('click', function() {
        $('.field-child-file_study_form,.field-child-file_scholarship_form').toggleClass('d-none');
        if (!$('.field-child-file_study_form').hasClass('d-none')) {
            $('#child-file_study_form').attr('required', true);
            $('.field-child-file_study_form').addClass('required');
        } else {
            $('#child-file_study_form').attr('required', false);
            $('.field-child-file_study_form').removeClass('required');
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
