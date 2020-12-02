<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use kartik\icons\Icon;
use yii\helpers\Html;

$spouse_is_work = 'd-none';
if ($spouse && $spouse->type == 1 && $spouse->is_work) {
    $spouse_is_work = '';
}

$spouse_is_do = 'd-none';
if ($spouse && $spouse->is_do) {
    $spouse_is_do = '';
}
?>
<div class="row">
    <div class="col-md-4">
        <!--$form->field($spouse, 'salary_file_form', [
            'template' => getFileInputTemplate($spouse->salary_file, 'Справка.pdf'),
        ])->fileInput(['class' => 'custom-file-input'])-->
        <!--$form->field($model, 'money_oklad')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']])-->
        <?= $form->field($model, 'money_summa_year')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_nalog_year')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'money_month_pay')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_user_pay')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
</div>

<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title">Документы</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h4 class="card-title">Работник:</h4><br>
                <?= $form->field($model, 'ndfl2_file_form', [
                    'template' => getFileInputTemplate($model->ndfl2_file, $model->attributeLabels()['ndfl2_file'] . '.pdf')
                ])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('ndfl2_file')) ?>
                <?= $form->field($model, 'ndfl2_file')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'spravka_zp_file_form', [
                    'options' => ['class' => (!$model->is_do) ? 'd-none':''],
                    'template' => getFileInputTemplate($model->spravka_zp_file, $model->attributeLabels()['spravka_zp_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input'])->hint($model->getAttributeHint('spravka_zp_file')) ?>
            </div>

            <?php if($spouse): ?>
                <div class="col-md-4">
                    <h4 class="card-title">Супруг(а):</h4>
                    <div class="spouse-is-work <?= $spouse_is_work ?>">
                        <?= $form->field($spouse, 'ndfl2_file_form', [
                            'template' => getFileInputTemplate($spouse->ndfl2_file, $spouse->attributeLabels()['ndfl2_file'] . '.pdf'),
                            'options' => ['style' => 'margin-top:10%'],
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                    <div class="spouse-is-do <?= $spouse_is_do ?>">
                        <?= $form->field($spouse, 'salary_file_form', [
                            'template' => getFileInputTemplate($spouse->salary_file, 'Справка.pdf'),
                            ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-md-4">
                <?= $form->field($model, 'other_income_file_form', [
                    'template' => getFileInputTemplate($model->other_income_file, 'Документы о доходах.pdf'),
                    'options' => ['style' => 'margin-top:10%'],
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
    </div>
</div>

<?php if ($model->filling_step == 6): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 6])->label(false) ?>
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
    if ($('#order-money_month_pay').val() && !$('#order-money_user_pay').val()) {
        $('#order-money_user_pay').val($('#order-money_month_pay').val());
    }
    $('#order-money_month_pay').on('change', function() {
        if (!$('#order-money_user_pay').val()){
            $('#order-money_user_pay').val($('#order-money_month_pay').val());
        }
    });
    
    $('div.field-order-money_oklad').addClass('required');
    $('div.field-order-money_summa_year').addClass('required');
    $('div.field-order-money_nalog_year').addClass('required');
    $('div.field-order-money_month_pay').addClass('required');
    $('div.field-order-money_user_pay').addClass('required');
    $('div.field-order-ndfl2_file_form').addClass('required');
    $('div.field-order-spravka_zp_file_form').addClass('required');
    $('div.field-spouse-ndfl2_file_form').addClass('required');
    $('div.field-spouse-salary_file_form').addClass('required');
    
    // Показываем поля загрузки справки, если сотрудник в ДО
    $('#order-is_do').on('click', function() {
        $('.field-order-spravka_zp_file_form').toggleClass('d-none');
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>