<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>
<div class="row">
    <div class="col-md-4">
        <!--$form->field($spose, 'salary_file_form', [
            'template' => getFileInputTemplate($spose->salary_file, 'Справка.pdf'),
        ])->fileInput(['class' => 'custom-file-input'])-->
        <?= $form->field($model, 'money_oklad')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_summa_year')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_nalog_year')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ndfl2_file_form', [
            'template' => getFileInputTemplate($model->ndfl2_file, $model->attributeLabels()['ndfl2_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('ndfl2_file')) ?>
        <?= $form->field($model, 'is_do')->checkbox()->hint($model->getAttributeHint('is_do')) ?>

        <?= $form->field($model, 'spravka_zp_file_form', [
            'options' => ['class' => (!$model->is_do) ? 'd-none':''],
            'template' => getFileInputTemplate($model->spravka_zp_file, $model->attributeLabels()['spravka_zp_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('spravka_zp_file')) ?>



    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'money_month_pay')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_user_pay')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    
    // Показываем поля загрузки справки, если сотрудник в ДО
    $('#order-is_do').on('click', function() {
        $('.field-order-spravka_zp_file_form').toggleClass('d-none');
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>