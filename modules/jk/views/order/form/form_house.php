<?php

use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

?>

<?php
// Тип жилого помещения из справочника был
/*$zaim_types = ZaimType::find()->all();
$zaim_types = ArrayHelper::map($zaim_types, 'id', 'title');
$params = [
    'prompt' => 'Укажите тип займа',
];
echo $form->field($model, 'zaim_type')->dropDownList($zaim_types, $params);*/
?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'jp_type')->dropDownList($model->getJPTypeList(), ['prompt' => 'Выберите ...']); ?>
        <?= $form->field($model, 'jp_params')->textarea() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'jp_date')->widget(
            DatePicker::classname(),
            [
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
                'options' => ['class' => 'form-control inputmask-date'],
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '2000:2050',
                    'changeYear' => true
                ],
            ]
        ) ?>
        <?= $form->field($model, 'jp_dist')->textInput() ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'jp_own')->dropDownList($model->getJPOwnList(), ['prompt' => 'Выберите ...']); ?>
        <?= $form->field($model, 'jp_part')->textarea() ?>
    </div>
</div>