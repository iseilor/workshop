<?php

use yii\jui\DatePicker;

?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'passport_series')->textInput() ?>
        <?= $form->field($model, 'passport_number')->textInput() ?>
        <?= $form->field($model, 'passport_date')->widget(
            DatePicker::class,
            [
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
                'options' => ['class' => 'form-control inputmask-date'],
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1950:2020',
                    'changeYear' => true
                ],
            ]
        ) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'passport_department')->textarea() ?>
        <?= $form->field($model, 'passport_code')->textInput() ?>
        <?= $form->field($model, 'passport_file', [
            'template' => getFileInputTemplate($model->passport_file, $model->attributeLabels()['passport_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'passport_registration')->textarea()->hint($model->attributeHints()['passport_registration']); ?>
        <?= $form->field($model, 'address_fact')->textarea()->hint($model->attributeHints()['address_fact']) ?>
    </div>
</div>