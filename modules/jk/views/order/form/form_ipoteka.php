<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

/**
 * @var \app\modules\jk\models\Order $model
 */
?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'jp_cost')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            <?= $form->field($model, 'jp_dogovor_date')->widget(
                DatePicker::class,
                [
                    'language' => 'ru',
                    'dateFormat' => 'dd.MM.yyyy',
                    'options' => ['class' => 'form-control inputmask-date'],
                    'clientOptions' => [
                        'changeMonth' => true,
                        'yearRange' => '2000:2050',
                        'changeYear' => true,
                    ],
                ]
            ) ?>
            <?= $form->field($model, 'ipoteka_target')->dropDownList($model->getIpotekaTargetList(), ['prompt' => 'Выберите ...']); ?>
            <?= $form->field($model, 'ipoteka_size')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            <?= $form->field($model, 'ipoteka_user')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            <?= $form->field($model, 'ipoteka_percent', ['options' => ['class' => 'form-group field-percent ' . $field_percent]])->widget(MaskedInput::class, [
                'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsPercent'],
            ]);
            ?>
            <?= $form->field($model, 'ipoteka_last_date', ['options' => ['class' => 'form-group field-percent ' . $field_percent]])->widget(DatePicker::class,
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
            <div class="field-percent <?= $field_percent ?>">
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

            <div class="field-zaim <?= $field_zaim ?>">
                <?= $form->field($model, 'ipoteka_file_bank_approval_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_bank_approval, $model->attributeLabels()['ipoteka_file_bank_approval'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>
        </div>
        <div class="col-md-4 field-percent  <?= $field_percent ?>">
            <?= $form->field($model, 'ipoteka_grafic')->textarea(['rows' => '15']); ?>
        </div>

    </div>

<?php if ($model->filling_step == 5): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 5])->label(false) ?>
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
    $('div.field-order-is_mortgage').addClass('required');
    $('div.field-order-ipoteka_target').addClass('required');
    $('div.field-order-ipoteka_size').addClass('required');
    $('div.field-order-ipoteka_user').addClass('required');
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
