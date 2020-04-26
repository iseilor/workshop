<?php

use yii\jui\DatePicker;

?>
<?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'gender')->dropDownList($model->getGenderList(), ['prompt' => 'Выберите ...']); ?>
<?= $form->field($model, 'date')->widget(
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
<?= $form->field($model, 'passport_file_form', [
    'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Если есть паспорт обязательно прикрепите его полную копию') ?>