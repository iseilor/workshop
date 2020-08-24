<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Html;

?>
<div class="form-group">
    <?= Html::checkbox('foreigner', 0, ['label' => 'Иностранец', 'id' => 'foreigner-address', 'style' => 'margin-top: 1rem;']) ?>
</div>
<?= $form->field($model, 'birth_series')->widget(MaskedInput::class, [
    'mask' => 'A-AA',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'birth_number')->widget(MaskedInput::class, [
    'mask' => '999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
]) ?>
<?= $form->field($model, 'birth_date')->widget(
    DatePicker::class,
    [
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => ['class' => 'form-control inputmask-date'],
        'clientOptions' => [
            'changeMonth' => true,
            'yearRange' => '1997:2020', // Не старше 23 лет
            'changeYear' => true,
        ],
    ]
) ?>
<?= $form->field($model, 'birth_department')->textarea(['maxlength' => true]) ?>
<!--$form->field($model, 'birth_code')->widget(MaskedInput::class, [
    'mask' => '99999999',
    'clientOptions' => [
        'clearIncomplete' => true,
    ],
])-->
<?= $form->field($model, 'birth_file_form', [
    'template' => getFileInputTemplate($model->birth_file, $model->attributeLabels()['birth_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#foreigner-address').on('change', function() {
        console.log($('#foreigner-address').prop('checked'));
        if ($('#foreigner-address').prop('checked') == true) {
            $('#child-birth_series').inputmask({ mask: ""});
            $('#child-birth_number').inputmask({ mask: ""});
            $('#child-birth_code').inputmask({ mask: ""});
            
            $('#child-passport_series').inputmask({ mask: ""});
            $('#child-passport_number').inputmask({ mask: ""});
            $('#child-passport_code').inputmask({ mask: ""});
        } else {
            $('#child-birth_series').inputmask({ mask: "A-AA"});
            $('#child-birth_number').inputmask({ mask: "999999"});
            $('#child-birth_code').inputmask({ mask: "99999999"});
            
            $('#child-passport_series').inputmask({ mask: "9999"});
            $('#child-passport_number').inputmask({ mask: "999999"});
            $('#child-passport_code').inputmask({ mask: "999-999"});
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
