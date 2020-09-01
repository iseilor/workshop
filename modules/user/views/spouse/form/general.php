<?php

use yii\jui\DatePicker;

?>
<?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
<!-- $form->field($model, 'gender')->dropDownList($model->getGenderList(), ['prompt' => 'Выберите ...']);
 $form->field($model, 'date')->widget(
    DatePicker::class,
    [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => ['class' => 'form-control inputmask-date'],
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1950:2000',
            'changeYear' => true,
        ],
    ]
)-->

<?= $form->field($model, 'marriage_file_form', [
    'template' => getFileInputTemplate($model->marriage_file,  'Копия.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    if($('#spouse-type').val() == 2) {
        $('.field-spouse-fio').addClass('d-none');
    }
    $('#spouse-type').on('change', function() {
        if($('#spouse-type').val() == 2) {
            $('.field-spouse-fio').addClass('d-none');
        } else {
            $('.field-spouse-fio').removeClass('d-none');
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>

