<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use kartik\icons\Icon;
use yii\helpers\Html;

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


<?php if ($model->filling_step == 6): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 7])->label(false) ?>
                </div>
                <div class="col-2">
                    <?= \yii\helpers\Html::submitButton(
                        \kartik\icons\Icon::show('play') . 'Далее',
                        [
                            'class' => 'btn btn-success float-right',
                            'id' => 'btn-save',
                            'value' => 1,
                            'name' => 'save',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


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