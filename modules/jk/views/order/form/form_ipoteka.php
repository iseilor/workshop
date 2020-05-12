<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

/**
 * @var \app\modules\jk\models\Order $model
 */

// Классы по ипотеки и по займу
$for_ipoteka = 'd-none';
$for_zaim = 'd-none';
if (isset($model->is_mortgage)) {
    if ($model->is_mortgage) {
        $for_ipoteka = '';
    } else {
        $for_zaim = '';
    }
}
?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'is_mortgage')->dropDownList($model->getMortgageList(), ['prompt' => 'Выберите ...']); ?>
            <?= $form->field($model, 'ipoteka_target')->dropDownList($model->getIpotekaTargetList(), ['prompt' => 'Выберите ...']); ?>
            <?= $form->field($model, 'ipoteka_size')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            <?= $form->field($model, 'ipoteka_user')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            <?= $form->field($model, 'ipoteka_percent', ['options' => ['class' => 'form-group for-ipoteka ' . $for_ipoteka]])->widget(MaskedInput::class, [
                'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsPercent'],
            ]);
            ?>
            <?= $form->field($model, 'ipoteka_last_date', ['options' => ['class' => 'form-group for-ipoteka ' . $for_ipoteka]])->widget(DatePicker::class,
                [
                    'language' => 'ru',
                    'dateFormat' => 'dd.MM.yyyy',
                    'options' => ['class' => 'form-control inputmask-date'],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'yearRange' => '2020:2050',
                        'changeYear' => true,
                    ],
                ]
            ) ?>
        </div>
        <div class="col-md-4">
            <div class="for-ipoteka <?= $for_ipoteka ?>">
                <?= $form->field($model, 'ipoteka_file_dogovor_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_dogovor, $model->attributeLabels()['ipoteka_file_dogovor'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'ipoteka_file_grafic_first_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_grafic_first, $model->attributeLabels()['ipoteka_file_grafic_first'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'ipoteka_file_grafic_now_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_grafic_now, $model->attributeLabels()['ipoteka_file_grafic_now'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                <?= $form->field($model, 'ipoteka_file_refenance_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_refenance, $model->attributeLabels()['ipoteka_file_refenance'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'ipoteka_file_spravka_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_spravka, $model->attributeLabels()['ipoteka_file_spravka'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>

            <div class="for-zaim <?= $for_zaim ?>">
                <?= $form->field($model, 'ipoteka_file_bank_approval_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_bank_approval, $model->attributeLabels()['ipoteka_file_bank_approval'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ipoteka_grafic')->textarea(['rows' => '15']); ?>
        </div>

    </div>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#order-is_mortgage').on('change', function() {
        if ($(this).val()==1){
            $('.for-ipoteka').removeClass('d-none');
            $('.for-zaim').addClass('d-none');
        }else{
            $('.for-ipoteka').addClass('d-none');
            $('.for-zaim').removeClass('d-none');
        }
        
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>