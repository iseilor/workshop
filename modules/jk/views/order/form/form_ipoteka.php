<?php

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Html;

/**
 * @var \app\modules\jk\models\Order $model
 */

$percent_required = false;
$zaim_required = false;
if ($field_percent == '') {
    $percent_required = true;
} elseif ($field_zaim == '') {
    $zaim_required = true;
}

?>
<div class="card card-solid card-secondary">
    <div class="card-body">
        <div class="row">
            <div class="col my-auto text-center">
                <?= $form->field($model, 'jp_cost')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            </div>
            <div class="col my-auto text-center">
                =
            </div>
            <div class="col my-auto text-center">
                <?= $form->field($model, 'ipoteka_user')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            </div>
            <div class="col my-auto text-center">
                +
            </div>
            <div class="col my-auto text-center">
                <?= $form->field($model, 'ipoteka_size')->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            </div>
            <div class="col my-auto text-center">
                +
            </div>
            <div class="col my-auto text-center">
                <?= $form->field($model, 'zaim_sum', ['options' => ['required' => $zaim_required]])->widget(MaskedInput::class, ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]); ?>
            </div>
        </div>
    </div>
</div>
    <div class="row second">
        <div class="col-md-4">
            <div class="field-percent <?= $field_percent ?>">
                <?= $form->field($model, 'ipoteka_start_date')->widget(
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

                <?= $form->field($model, 'ipoteka_last_date', ['options' => ['class' => 'form-group field-percent ' . $field_percent, 'required' => $percent_required]])
                    ->widget(DatePicker::class,
                        [
                            'language' => 'ru',
                            'dateFormat' => 'dd.MM.yyyy',
                            'options' => ['class' => 'form-control inputmask-date', 'required' => $percent_required],
                            'clientOptions' => [
                                'changeMonth' => true,
                                'yearRange' => '2020:2050',
                                'changeYear' => true,
                            ],
                        ]
                    ) ?>

                <?= $form->field($model, 'ipoteka_target')->dropDownList($model->getIpotekaTargetList(), ['prompt' => 'Выберите ...']); ?>
            </div>

            <div class="field-zaim <?= $field_zaim ?>">
                <?= $form->field($model, 'ipoteka_percent', ['options' => ['class' => 'form-group']])
                    ->widget(MaskedInput::class, [
                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsPercent'],
                    'options' => ['required' => ($zaim_required && $model->ipoteka_percent && $model->ipoteka_size != 0)],
                ]);?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="field-percent <?= $field_percent ?>">
                <?= $form->field($model, 'ipoteka_file_dogovor_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_dogovor, $model->attributeLabels()['ipoteka_file_dogovor'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input', 'required' => ($percent_required && !isset($model->ipoteka_file_dogovor))]) ?>

                <div class="form-group">
                    <?= Html::checkbox('early_payments', 0, ['label' => 'За период использования Ипотекой были произведены досрочные платежи?',
                        'id' => 'early_payments',
                        'style' => 'margin-top: 1rem;',
                        'checked' => ($model->ipoteka_file_grafic_now) ? true : false]) ?>
                </div>

                <div class="early_payments <?= $model->ipoteka_file_grafic_now ? '' : 'd-none' ?>">
                    <?= $form->field($model, 'ipoteka_file_grafic_now_form', [
                        'template' => getFileInputTemplate($model->ipoteka_file_grafic_now, $model->attributeLabels()['ipoteka_file_grafic_now'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>

                    <?= $form->field($model, 'ipoteka_file_spravka_form', [
                        'template' => getFileInputTemplate($model->ipoteka_file_spravka, $model->attributeLabels()['ipoteka_file_spravka'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>

                <div class="form-group">
                    <?= Html::checkbox('refinancing', 0, ['label' => 'Вы делали рефинансирование?',
                        'id' => 'refinancing',
                        'style' => 'margin-top: 1rem;',
                        'checked' => ($model->ipoteka_file_refenance) ? true : false]) ?>
                </div>

                <div class="refinancing <?= $model->ipoteka_file_refenance ? '' : 'd-none' ?>">
                    <?= $form->field($model, 'ipoteka_file_grafic_first_form', [
                        'template' => getFileInputTemplate($model->ipoteka_file_grafic_first, $model->attributeLabels()['ipoteka_file_grafic_first'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>

                    <?= $form->field($model, 'ipoteka_file_refenance_form', [
                        'template' => getFileInputTemplate($model->ipoteka_file_refenance, $model->attributeLabels()['ipoteka_file_refenance'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>

            <div class="field-zaim <?= $field_zaim ?>">
                <?= $form->field($model, 'ipoteka_file_bank_approval_form', [
                    'template' => getFileInputTemplate($model->ipoteka_file_bank_approval, $model->attributeLabels()['ipoteka_file_bank_approval'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input', 'required' => ($zaim_required && !isset($model->ipoteka_file_bank_approval) && $model->ipoteka_size != 0)]) ?>
            </div>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'ipoteka_grafic', ['options' => ['class' => 'form-group ' . ($zaim_required ? 'd-none' : '')]])->textarea(['rows' => '15']); ?>
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
    var arr = [
                  '.field-order-ipoteka_file_dogovor_form',
                  '.field-order-ipoteka_file_grafic_now_form',
                  '.field-order-ipoteka_file_grafic_first_form',
                  '.field-order-ipoteka_file_refenance_form',
                  '.field-order-ipoteka_file_bank_approval_form',
                ];
    arr.forEach(function(item, _, _) {
        if (!$(item + ' label[for=exampleInputFile]').html()) {
            $(item).addClass('required');
        }
    });
    
    $('div.field-order-jp_cost').addClass('required');
    //$('div.field-order-ipoteka_target').addClass('required');
    $('div.field-order-ipoteka_size').addClass('required');
    $('div.field-order-ipoteka_user').addClass('required');
    $('div.field-order-ipoteka_last_date').addClass('required');
    //$('div.field-order-ipoteka_file_dogovor_form').addClass('required');
    //$('div.field-order-ipoteka_file_grafic_now_form').addClass('required');
    //$('div.field-order-ipoteka_file_spravka_form').addClass('required');
    //$('div.field-order-ipoteka_file_grafic_first_form').addClass('required');
    //$('div.field-order-ipoteka_file_refenance_form').addClass('required');
    $('div.field-order-ipoteka_percent').addClass('required');
    //$('div.field-order-ipoteka_file_bank_approval_form').addClass('required');
    if ($('#order-is_mortgage').val()==0) {
        $('.field-order-zaim_sum').addClass('required');
    }
    
    if ($('#order-ipoteka_size').val()==0 && $('#order-is_mortgage').val()==0) {
        $('.second').addClass('d-none');
    }
    
    $('#order-ipoteka_size').on('change', function() {
        if ($('#order-is_mortgage').val()==0) {
            if ($('#order-ipoteka_size').val()==0) {
                $('.second').addClass('d-none');
                $('#order-ipoteka_percent').attr('required', false);
                $('#order-ipoteka_file_bank_approval_form').attr('required', false);
            } else {
                $('.second').removeClass('d-none');
                $('#order-ipoteka_percent').attr('required', true);
                if (!$('.field-order-ipoteka_file_bank_approval_form label[for=exampleInputFile]').html()) {
                    $('#order-ipoteka_file_bank_approval_form').attr('required', true);
                }
            }
        }
    });
    
    $('#early_payments').on('change', function() {
        $('.early_payments').toggleClass('d-none');
        if (!$('.field-order-ipoteka_file_grafic_now_form label[for=exampleInputFile]').html()) {
            $('#order-ipoteka_file_grafic_now_form').attr('required', function(_, attr){ return !attr; });
        }
        
    });
    
    $('#refinancing').on('change', function() {
        $('.refinancing').toggleClass('d-none');
        if (!$('.field-order-ipoteka_file_refenance_form label[for=exampleInputFile]').html()) {
            $('#order-ipoteka_file_refenance_form').attr('required', function(_, attr){ return !attr; });
        }
        if (!$('.field-order-ipoteka_file_grafic_first_form label[for=exampleInputFile]').html()) {
            $('#order-ipoteka_file_grafic_first_form').attr('required', function(_, attr){ return !attr; });
        }
        //$('#order-ipoteka_file_grafic_first_form, #order-ipoteka_file_refenance_form').attr('required', function(_, attr){ return !attr; })
    });
    
    $('#order-is_mortgage').on('change', function() {
        if ($('#order-is_mortgage').val()==1) {
            $('#order-zaim_sum').attr('required', false);
            $('.field-order-zaim_sum').removeClass('required');
            
            $('.field-order-ipoteka_grafic').removeClass('d-none');
            
            $('.second').removeClass('d-none');
            $('#order-ipoteka_file_bank_approval_form').attr('required', false);
            $('#order-ipoteka_percent').attr('required', false);
        } else if ($('#order-is_mortgage').val()==0) {
            $('#order-zaim_sum').attr('required', true);
            $('.field-order-zaim_sum').addClass('required');
            
            $('.field-order-ipoteka_grafic').addClass('d-none');
            
            if ($('#order-ipoteka_size').val() == 0) {
                $('.second').addClass('d-none');
                $('#order-ipoteka_percent').attr('required', false);
                $('#order-ipoteka_file_bank_approval_form').attr('required', false);
            } else {
                $('.second').removeClass('d-none');
                if (!$('.field-order-ipoteka_file_bank_approval_form label[for=exampleInputFile]').html()) {
                    $('#order-ipoteka_file_bank_approval_form').attr('required', true);
                }
                $('#order-ipoteka_percent').attr('required', true);
            }
            
        }
        
        $('#order-ipoteka_last_date').attr('required', function(_, attr){ return !attr; });
        
        if (!$('.field-order-ipoteka_file_dogovor_form label[for=exampleInputFile]').html()) {
            $('#order-ipoteka_file_dogovor_form').attr('required', function(_, attr){ return !attr; });
        }
        
        if ($('#early_payments').prop('checked')==true) {
            //$('#order-ipoteka_file_grafic_now_form').attr('required', function(_, attr){ return !attr; });
            if (!$('.field-order-ipoteka_file_grafic_now_form label[for=exampleInputFile]').html()) {
                $('#order-ipoteka_file_grafic_now_form').attr('required', function(_, attr){ return !attr; });
            }
        }
        if ($('#refinancing').prop('checked')==true) {
            $('#order-ipoteka_file_grafic_first_form, #order-ipoteka_file_refenance_form').attr('required', function(_, attr){ return !attr; });
            if (!$('.field-order-ipoteka_file_grafic_first_form label[for=exampleInputFile]').html()) {
                $('#order-ipoteka_file_grafic_first_form').attr('required', function(_, attr){ return !attr; });
            }
            if (!$('.field-order-ipoteka_file_refenance_form label[for=exampleInputFile]').html()) {
                $('#order-ipoteka_file_refenance_form').attr('required', function(_, attr){ return !attr; });
            }
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
