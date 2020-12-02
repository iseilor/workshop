<?= $form->field($model, 'is_work')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите ...']); ?>
<?= $form->field($model, 'is_rtk', ['options' => ['class' => (!$model->is_work) ? 'd-none' : '']])->checkbox() ?>
<?= $form->field($model, 'is_do', ['options' => ['class' => (!$model->is_work) ? 'd-none' : '']])->checkbox() ?>

<?= $form->field($model, 'work_file_form', [
    'options' => ['class' => 'd-none'],
    'template' => getFileInputTemplate($model->work_file, $model->attributeLabels()['work_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?= $form->field($model, 'unemployment_file_form', [
    'options' => ['class' => ($model->is_work) ? 'd-none' : ''],
    'template' => getFileInputTemplate($model->unemployment_file, $model->attributeLabels()['unemployment_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>
<?= $form->field($model, 'explanatory_note_file_form', [
    'options' => ['class' => ($model->is_work) ? 'd-none' : ''],
    'template' => getFileInputTemplate($model->explanatory_note_file, $model->attributeLabels()['explanatory_note_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('div.field-spouse-is_work').addClass('required');
    $('#spouse-is_work').on('change', function() {
        if ($(this).val()==1){
            $('.field-spouse-is_rtk,.field-spouse-is_do,.field-spouse-salary_file_form').removeClass('d-none');
            $('.field-spouse-unemployment_file_form, .field-spouse-explanatory_note_file_form, .field-spouse-work_file_form').addClass('d-none');
        }else{
            $('.field-spouse-is_rtk,.field-spouse-is_do,.field-spouse-salary_file_form').addClass('d-none');
            $('.field-spouse-unemployment_file_form, .field-spouse-explanatory_note_file_form, .field-spouse-work_file_form').removeClass('d-none');
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>


