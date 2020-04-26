<?= $form->field($model, 'registration_file_form', [
    'template' => getFileInputTemplate($model->registration_file, $model->attributeLabels()['registration_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('При наличии') ?>

<?= $form->field($model, 'edj_file_form', [
    'template' => getFileInputTemplate($model->edj_file, $model->attributeLabels()['edj_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>