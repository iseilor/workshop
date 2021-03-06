<?php

use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use yii\helpers\Html;
use kartik\icons\Icon;
use yii\helpers\Url;

$is_new_building = 'd-none';
if (isset($model->is_new_building)) {
    if ($model->is_new_building) {
        $is_new_building = '';
    }
}

$is_parts = 'd-none';
if (isset($model->is_parts)) {
    if ($model->is_parts) {
        $is_parts = '';
    }
}

$mortgage = !isset($model->is_mortgage);

if (!isset($model->is_mortgage)) {
    $contract = 'd-none';
} else {
    $contract = '';
}

$u_construction = (!$mortgage && $model->jp_new_type == 1) ? 'true' : 'false';
$jp_date_max = date("Y");
?>

<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'family_own')->textarea(['rows'=>10]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'family_deal')->textarea(['rows'=>10]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'jp_total_area')->textInput(); ?>
        </div>
    </div>
</div>

<?= $form->field($model, 'is_mortgage')->dropDownList($model->getMortgageList(), ['prompt' => 'Выберите ...']); ?>

<div id="contract" class="card card-solid card-secondary <?= $contract ?>">
    <div class="card-header with-border">
        <h3 class="card-title">Помощь Общества будет направлена для приобретения жилого помещения у лиц, не являющимися взаимозависимыми в соответствии с п.2 статьи 105.1 Налогового Кодекса РФ:</h3>
    </div><!-- /.box-header -->
    <div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <div class="field-percent <?= $field_percent ?>">
                <?= $form->field($model, 'jp_address')->textarea(['required' => ($field_zaim == 'd-none')]) ?>
            </div>
            <?= $form->field($model, 'jp_new_type')->dropDownList($model->getJPTypeList(), ['prompt' => 'Выберите ...',
                'onChange' => 'JS: var value = (this.value);
                                    if(value == 1){$(".field-order-jp_new_room_count").addClass("d-none"); $("#order-jp_new_room_count").attr("required", false);}
                                    else if(value == 2){$(".field-order-jp_new_room_count").removeClass("d-none"); $("#order-jp_new_room_count").attr("required", true);}
                                    else if(value == 3){$(".field-order-jp_new_room_count").addClass("d-none"); $("#order-jp_new_room_count").attr("required", false);}
                                    else {$(".field-order-jp_new_room_count").addClass("d-none"); $("#order-jp_new_room_count").attr("required", false);}']); ?>

            <?= $form->field($model, 'jp_new_room_count',['options' => [
                'class' => $model->jp_new_type == 2 ? 'form-group' : 'form-group d-none'
            ]])->textInput(); ?>

            <?= $form->field($model, 'jp_new_area')->textInput() ?>

        </div>
        <div class="col-md-4">

            <?= $form->field($model, 'is_new_building')->checkbox(
                ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]) ?>

            <div class="new_building <?= $is_new_building ?>">
                <?= $form->field($model, 'jp_date')->widget(
                    DatePicker::class,
                    [
                        'language' => 'ru',
                        'dateFormat' => 'dd.MM.yyyy',
                        'options' => ['class' => 'form-control inputmask-date', 'required' => ($is_new_building == '' && $model->is_mortgage == 1)],
                        'clientOptions' => [
                            'changeMonth' => true,
                            'yearRange' => "2000:2050",
                            'changeYear' => true,
                            'onClose' => new \yii\web\JsExpression("
                            function(dateText, inst) {
                                now = new Date();
                                
                                if (dateText != '') {
                                    arr = dateText.split('.');
                                    selected = new Date(arr[2],arr[1] - 1, arr[0]);
                                } else {
                                    selected = new Date();
                                }
                             }")
                        ],
                    ]
                ) ?>
            </div>

            <div class="field-percent <?= $field_percent ?>">
                <?= $form->field($model, 'is_parts')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]) ?>

                <?= $form->field($model, 'jp_part', [
                        'options' => ['class' => 'parts ' . $is_parts],
                    ])->textarea(['rows' => 8]) ?>
            </div>
            <div class="field-zaim <?= $field_zaim ?>">
                <?= $form->field($model, 'district_id')->dropDownList(ArrayHelper::map($mins, 'id', 'title'), ['prompt' => 'Выберите...', 'required' => ($field_zaim == '')]); ?>
                <?= $form->field($model, 'under_construction')->checkbox(
                    ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]) ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="field-percent <?= $field_percent ?>">
                <?= $form->field($model, 'jp_dogovor_buy_file_form', [
                    'template' => getFileInputTemplate($model->jp_dogovor_buy_file, $model->attributeLabels()['jp_dogovor_buy_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                <?= $form->field($model, 'jp_act_file_form', [
                    'template' => getFileInputTemplate($model->jp_act_file, $model->attributeLabels()['jp_act_file'] . '.pdf'),
                    'options' => ['class' => !$is_new_building],
                ])->fileInput(['class' => 'custom-file-input']) ?>
                <?= $form->field($model, 'jp_egrp_file_form', [
                    'template' => getFileInputTemplate($model->jp_egrp_file, $model->attributeLabels()['jp_egrp_file'] . '.pdf'),
                    'options' => ['class' => !$is_new_building],
                ])->fileInput(['class' => 'custom-file-input']) ?>
            </div>

            <div class="field-zaim <?= $field_zaim ?>">
                <?= $form->field($model, 'jp_dogovor_bron_file_form', [
                    'template' => getFileInputTemplate($model->jp_dogovor_bron_file, $model->attributeLabels()['jp_dogovor_bron_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_own_land_file_form', [
                    'template' => getFileInputTemplate($model->jp_own_land_file, $model->attributeLabels()['jp_own_land_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_grad_plane_file_form', [
                    'template' => getFileInputTemplate($model->jp_grad_plane_file, $model->attributeLabels()['jp_grad_plane_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_scheme_plane_org_file_form', [
                    'template' => getFileInputTemplate($model->jp_scheme_plane_org_file, $model->attributeLabels()['jp_scheme_plane_org_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input'])?>

                <?= $form->field($model, 'jp_building_permit_file_form', [
                    'template' => getFileInputTemplate($model->jp_building_permit_file, $model->attributeLabels()['jp_building_permit_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_project_house_file_form', [
                    'template' => getFileInputTemplate($model->jp_project_house_file, $model->attributeLabels()['jp_project_house_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_construction_estimate_file_form', [
                    'template' => getFileInputTemplate($model->jp_construction_estimate_file, $model->attributeLabels()['jp_construction_estimate_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_time_grafic_build_file_form', [
                    'template' => getFileInputTemplate($model->jp_time_grafic_build_file, $model->attributeLabels()['jp_time_grafic_build_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_photo_file_form', [
                    'template' => getFileInputTemplate($model->jp_photo_file, $model->attributeLabels()['jp_photo_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

                <?= $form->field($model, 'jp_template_report_file_form', [
                    'template' => getFileInputTemplate($model->jp_template_report_file, $model->attributeLabels()['jp_template_report_file'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input'])->hint(Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR])
                        . 'Образец заявления', Url::base().Url::to('/files/jk/order/template_construction_report.xlsx'), ['target' => '_blank'])) ?>
            </div>
        </div>
    </div>
    </div>
</div>

<?php if ($model->filling_step == 4): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 4])->label(false) ?>
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
<?php endif;

$script = <<< JS
$(document).ready(function() {
    $("#order-jp_new_room_count").inputmask({regex: "^[0-9]*[.,]?[0-9]+$", rightAlign: false, placeholder: ''});
    $("#order-jp_new_area").inputmask({regex: "^[0-9]*[.,]?[0-9]+$", rightAlign: false, placeholder: ''});
    $("#order-jp_part").inputmask({regex: "^[0-9]*[.,]?[0-9]+$", rightAlign: false, placeholder: ''});
    $('#order-jp_part').css('height', 'calc(2.25rem + 2px)');
    $('.field-order-jp_total_area').addClass('required');
    $('#order-jp_total_area').attr('required', true);
    $('.field-order-district_id').addClass('required');
    $('div.field-order-is_mortgage').addClass('required');
    $('div.field-order-family_own').addClass('required');
    $('div.field-order-family_deal').addClass('required');
    $('div.field-order-jp_address').addClass('required');
    $('div.field-order-jp_new_type').addClass('required');
    $('div.field-order-jp_new_room_count').addClass('required');
    $('div.field-order-jp_new_area').addClass('required');
    $('div.field-order-jp_part').addClass('required');
    $('div.field-order-jp_date').addClass('required');
    $('.field-order-jp_dogovor_buy_file_form').addClass('required');
    $('.field-order-jp_egrp_file_form').addClass('required');
    //$('.field-order-jp_act_file_form').addClass('required');
    
    var constr_fields_map = new Map([
                      ['#order-jp_own_land_file_form', '.field-order-jp_own_land_file_form'],
                      ['#order-jp_grad_plane_file_form', '.field-order-jp_grad_plane_file_form'],
                      ['#order-jp_scheme_plane_org_file_form', '.field-order-jp_scheme_plane_org_file_form'],
                      ['#order-jp_building_permit_file_form', '.field-order-jp_building_permit_file_form'],
                      ['#order-jp_project_house_file_form', '.field-order-jp_project_house_file_form'],
                      ['#order-jp_construction_estimate_file_form', '.field-order-jp_construction_estimate_file_form'],
                      ['#order-jp_time_grafic_build_file_form', '.field-order-jp_time_grafic_build_file_form'],
                      ['#order-jp_photo_file_form', '.field-order-jp_photo_file_form'],
                      ['#order-jp_template_report_file_form', '.field-order-jp_template_report_file_form']
                    ]);
    
    $('#order-is_mortgage').on('change load', function() {
        if ($('#order-is_mortgage').val()) {
            $('#contract').removeClass('d-none');
            
            if ($('#order-is_new_building').prop('checked')==true && $('#order-is_mortgage').val() == 0) {
                $('.new_building').addClass('d-none');
                $('#order-jp_date').attr('required', false);
            }
            
            if ($('#order-under_construction').prop('checked')==true && $('#order-is_mortgage').val() == 0){
                for (let pair of constr_fields_map.entries()) {
                  $(`\${pair[1]}`).removeClass('d-none');
                  if (!$(`\${pair[1]}` + ' label[for=exampleInputFile]').html()) {
                      $(`\${pair[1]}`).addClass('required');
                      $(`\${pair[0]}`).attr('required', true);
                  }
                }
                $('#order-district_id').attr('required', true);
            } else {
                for (let pair of constr_fields_map.entries()) {
                  $(`\${pair[1]}`).removeClass('required').addClass('d-none');
                  $(`\${pair[0]}`).attr('required', false);
                }
                $('#order-district_id').attr('required', false);
            }
            
            if ($('#order-is_mortgage').val() == 1) {
                if ($('#order-is_new_building').prop('checked')==true){
                    $('.new_building').removeClass('d-none');
                    $('#order-jp_date').attr('required', true);
                }
                if (!$('.field-order-jp_dogovor_buy_file_form label[for=exampleInputFile]').html()) {
                    //$('.field-order-jp_dogovor_buy_file_form').addClass('required');
                    $('#order-jp_dogovor_buy_file_form').attr('required', true);
                }
                
                if (!$('.field-order-jp_egrp_file_form label[for=exampleInputFile]').html()) {
                    //$('.field-order-jp_egrp_file_form').addClass('required');
                    $('#order-jp_egrp_file_form').attr('required', true);
                }
                $('#order-jp_address').attr('required', true);
            } else {
                $('#order-jp_dogovor_buy_file_form').attr('required', false);
                $('#order-jp_egrp_file_form').attr('required', false);
                $('#order-jp_address').attr('required', false);
            }
        } else {
            $('#contract').addClass('d-none');
            
            $('#order-jp_dogovor_buy_file_form').attr('required', false);
            $('#order-jp_egrp_file_form').attr('required', false);
        }
    });
    
    $('#order-is_new_building').on('change', function() {
        if ($(this).prop('checked')==true){
            if ($('#order-is_mortgage').val() == 1) {
                $('.new_building').removeClass('d-none');
                $('#order-jp_date').attr('required', true);
            }
            $('.field-order-jp_act_file_form').addClass('d-none');
            $('.field-order-jp_egrp_file_form').addClass('d-none');
            
            //$('.field-order-jp_egrp_file_form').removeClass('required');
            $('#order-jp_egrp_file_form').attr('required', false);
        } else {
            if ($('#order-is_mortgage').val() == 1) {
                $('#order-jp_date').attr('required', false);
            }
            $('.field-order-jp_act_file_form').removeClass('d-none');
            $('.field-order-jp_egrp_file_form').removeClass('d-none');
            $('.new_building').addClass('d-none');
            if (!$('.field-order-jp_egrp_file_form label[for=exampleInputFile]').html()) {
                if ($('#order-is_mortgage').val() == 1) {
                    //$('.field-order-jp_egrp_file_form').addClass('required');
                    $('#order-jp_egrp_file_form').attr('required', true);
                }
            }
        }
    });
    
    if ($('#order-is_parts').prop('checked')==true) {
        $('#order-jp_part').attr('required', true);
    }
    
    $('#order-is_parts').on('change', function() {
        if ($(this).prop('checked')==true){
            $('.parts').removeClass('d-none');
            $('#order-jp_part').attr('required', true);
        } else {
            $('.parts').addClass('d-none');
            $('#order-jp_part').attr('required', false);
        }
    });
    
    if (!$u_construction) {
        $('.field-order-under_construction').addClass('d-none');
    }
    
    if ($('#order-under_construction').prop('checked')==false){
        for (let value of constr_fields_map.values()) {
            $(value).addClass('d-none');
        }
    } else {
        for (let pair of constr_fields_map.entries()) {
            if (!$(`\${pair[1]}` + ' label[for=exampleInputFile]').html()) {
                $(`\${pair[1]}`).addClass('required');
                $(`\${pair[0]}`).attr('required', true);
            }
        }
    }
    
    $('#order-under_construction').on('change', function() {
        if ($(this).prop('checked')==true){
            for (let pair of constr_fields_map.entries()) {
              $(`\${pair[1]}`).removeClass('d-none');
              if (!$(`\${pair[1]}` + ' label[for=exampleInputFile]').html()) {
                  $(`\${pair[1]}`).addClass('required');
                  $(`\${pair[0]}`).attr('required', true);
              }
            }
        } else {
            for (let pair of constr_fields_map.entries()) {
              $(`\${pair[1]}`).removeClass('required').addClass('d-none');
              $(`\${pair[0]}`).attr('required', false);
            }
        }
    });
    
    $('#order-jp_new_type').on('change', function() {
        if ($('#order-jp_new_type').val() == 1) {
            $('.field-order-under_construction').removeClass('d-none');
        } else {
            $('.field-order-under_construction').addClass('d-none');
        }
    });

});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
