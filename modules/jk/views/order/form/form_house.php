<?php

use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>


<div class="row">
    <div class="col-md-4">

        <?= $form->field($model, 'jp_address')->textarea() ?>
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
        <?= $form->field($model, 'jp_registration_date')->widget(
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
    </div>
    <div class="col-md-4">
        <div class="field-percent <?= $field_percent ?>">
            <?= $form->field($model, 'jp_date')->widget(
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
            <?= $form->field($model, 'jp_dist')->textInput() ?>
        </div>

        <?= $form->field($model, 'jp_part')->textarea(['rows' => 8]) ?>
        <?= $form->field($model, 'jp_own')->dropDownList($model->getJPOwnList(), ['prompt' => 'Выберите ...']); ?>
    </div>
    <div class="col-md-4">

        <div class="field-percent <?= $field_percent ?>">
            <?= $form->field($model, 'jp_dogovor_buy_file_form', [
                'template' => getFileInputTemplate($model->jp_dogovor_buy_file, $model->attributeLabels()['jp_dogovor_buy_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
            <?= $form->field($model, 'jp_act_file_form', [
                'template' => getFileInputTemplate($model->jp_act_file, $model->attributeLabels()['jp_act_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
            <?= $form->field($model, 'jp_egrp_file_form', [
                'template' => getFileInputTemplate($model->jp_egrp_file, $model->attributeLabels()['jp_egrp_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
            <?= $form->field($model, 'jp_own_land_file_form', [
                'template' => getFileInputTemplate($model->jp_own_land_file, $model->attributeLabels()['jp_own_land_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
            <?= $form->field($model, 'jp_own_house_file_form', [
                'template' => getFileInputTemplate($model->jp_own_house_file, $model->attributeLabels()['jp_own_house_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>
        </div>

        <div class="field-zaim <?= $field_zaim ?>">
            <?= $form->field($model, 'jp_dogovor_bron_file_form', [
                'template' => getFileInputTemplate($model->jp_dogovor_bron_file, $model->attributeLabels()['jp_dogovor_bron_file'] . '.pdf'),
            ])->fileInput(['class' => 'custom-file-input']) ?>

            <?= $form->field($model, 'jp_pravo_document_file_form', [
                'template' => getFileInputTemplate($model->jp_pravo_document_file, $model->attributeLabels()['jp_pravo_document_file'] . '.pdf'),
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
            ])->fileInput(['class' => 'custom-file-input']) ?>
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