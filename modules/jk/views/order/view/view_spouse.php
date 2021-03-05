<?php

use app\modules\user\models\Spouse;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
 * @var \app\modules\jk\models\Order $model
 */
// Ищем супругу. Если есть, то можно редактировать, если нет, то можно добавить
// Обновить можно всегда
$spouse = Spouse::find()->where(['user_id' => $model->created_by])->one();

if ($spouse) {

    $attr = [
        [
            'attribute' => 'type',
            'value' => Spouse::getTypeList()[$spouse->type],
        ],
        'fio',
        viewFieldFile($spouse, 'marriage_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=marriage_file']),
        'passport_registration',
        'passport_series',
        'passport_number',
        'passport_date:date',
        'passport_department',
        'passport_code',
        viewFieldFile($spouse, 'passport_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=passport_file']),

    ];
    if (isset($spouse->registration_file)) {
        $attr[] = viewFieldFile($spouse, 'registration_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=registration_file']);
    }
    if (isset($spouse->edj_file)) {
        $attr[] = viewFieldFile($spouse, 'edj_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=edj_file']);
    }
    $attr[] = [
        'attribute' => 'is_work',
        'value' => (isset($spouse->is_work) && $spouse->is_work) ? 'Да' : 'Нет',
    ];
    if (isset($spouse->is_work) && $spouse->is_work) {
        if (isset($model->is_rtk) && $model->is_rtk) {
            $attr[] = [
                'attribute' => 'is_rtk',
                'value' => 'Да'
            ];
        }
        if (isset($model->is_do) && $model->is_do) {
            $attr[] = [
                'attribute' => 'is_do',
                'value' => (isset($model->is_do) && $model->is_do) ? 'Да' : 'Нет',
            ];
        }
    } else {
        array_push($attr,
            viewFieldFile($spouse, 'work_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=work_file']),
            viewFieldFile($spouse, 'unemployment_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=unemployment_file']),
            viewFieldFile($spouse, 'explanatory_note_file', ['/jk/order/' . $spouse->id . '/acs-ctrl?model=spouse&field=explanatory_note_file'])
        );
    }

    echo DetailView::widget([
        'model' => $spouse,
        'attributes' => $attr
    ]);
} else {
    $data = [
        'Наличие супруги' => 'Нет',
    ];
    echo DetailView::widget([
        'model' => $data,
        'attributes' => [
            'Наличие супруги',
        ],
    ]);
}