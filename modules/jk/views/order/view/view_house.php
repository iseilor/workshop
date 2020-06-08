<?php


use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;


// Путь до файла в этом VIEW
function filePath($model, $attr)
{
    return ($model->{$attr}) ? Html::a(
        Icon::show('file-pdf') . $model->attributeLabels()[$attr],
        Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->{$attr}]),
        ['target' => '_blank']) : '';
}


echo DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => $model->attributeLabels()['jp_type'],
            'value' => $model::getJPTypeName($model->jp_type),
        ],
        'jp_address' ,
        'jp_room_count',
        'jp_area',
        'jp_cost:currency',
        'jp_dogovor_date:date',
        'jp_registration_date:date',
        'jp_date:date',
        [
            'label' => $model->attributeLabels()['jp_own'],
            'value' => $model::getJPOwnName($model->jp_own),
        ],
        'jp_part',
        'jp_dist',

        [
            'attribute' => 'jp_dogovor_buy_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_dogovor_buy_file'),
        ],
        [
            'attribute' => 'jp_act_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_act_file'),
        ],
        [
            'attribute' => 'jp_egrp_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_egrp_file'),
        ],
        [
            'attribute' => 'jp_own_land_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_own_land_file'),
        ],
        [
            'attribute' => 'jp_own_house_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_own_house_file'),
        ],

        [
            'attribute' => 'jp_dogovor_bron_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_dogovor_bron_file'),
        ],
        [
            'attribute' => 'jp_pravo_document_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_pravo_document_file'),
        ],
        [
            'attribute' => 'jp_grad_plane_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_grad_plane_file'),
        ],
        [
            'attribute' => 'jp_scheme_plane_org_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_scheme_plane_org_file'),
        ],
        [
            'attribute' => 'jp_building_permit_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_building_permit_file'),
        ],
        [
            'attribute' => 'jp_project_house_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_project_house_file'),
        ],
        [
            'attribute' => 'jp_construction_estimate_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_construction_estimate_file'),
        ],
        [
            'attribute' => 'jp_time_grafic_build_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_time_grafic_build_file'),
        ],
        [
            'attribute' => 'jp_photo_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_photo_file'),
        ],
        [
            'attribute' => 'jp_template_report_file',
            'format' => 'raw',
            'value' => filePath($model, 'jp_template_report_file'),
        ],
    ],
]);