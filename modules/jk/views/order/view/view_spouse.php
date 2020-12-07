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
        viewFieldFile($spouse, 'marriage_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->marriage_file]),
        'passport_registration',
        'passport_series',
        'passport_number',
        'passport_date:date',
        'passport_department',
        'passport_code',
        viewFieldFile($spouse, 'passport_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->passport_file]),

    ];
    if (isset($spouse->registration_file)) {
        $attr[] = viewFieldFile($spouse, 'registration_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->registration_file]);
    }
    if (isset($spouse->edj_file)) {
        $attr[] = viewFieldFile($spouse, 'edj_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->edj_file]);
    }
    $attr[] = [
        'attribute' => 'is_work',
        'value' => (isset($spouse->is_work) && $spouse->is_work) ? 'Да' : 'Нет',
    ];
    if (isset($spouse->is_work) && $spouse->is_work) {
        array_push($attr,
            [
                'attribute' => 'is_rtk',
                'value' => (isset($spouse->is_rtk) && $spouse->is_rtk) ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'is_do',
                'value' => (isset($spouse->is_do) && $spouse->is_do) ? 'Да' : 'Нет',
            ]
        );
    } else {
        array_push($attr,
            viewFieldFile($spouse, 'work_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->work_file]),
            viewFieldFile($spouse, 'unemployment_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->unemployment_file]),
            viewFieldFile($spouse, 'explanatory_note_file', ['/' . Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->explanatory_note_file])
        );
    }

    echo DetailView::widget([
        'model' => $spouse,
        'attributes' => $attr/*[
            [
                'attribute' => 'type',
                'value' => Spouse::getTypeList()[$spouse->type],
            ],
            'fio',
            viewFieldFile($spouse, 'marriage_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->marriage_file),
            'passport_registration',
            'passport_series',
            'passport_number',
            'passport_date:date',
            'passport_department',
            'passport_code',
            viewFieldFile($spouse, 'passport_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->passport_file),
            viewFieldFile($spouse, 'edj_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->edj_file),
            viewFieldFile($spouse, 'registration_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->registration_file),

            [
                'attribute' => 'is_work',
                'value' => (isset($spouse->is_work) && $spouse->is_work) ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'is_rtk',
                'value' => (isset($spouse->is_rtk) && $spouse->is_rtk) ? 'Да' : 'Нет',
            ],
            [
                'attribute' => 'is_do',
                'value' => (isset($spouse->is_do) && $spouse->is_do) ? 'Да' : 'Нет',
            ],

            viewFieldFile($spouse, 'explanatory_note_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->explanatory_note_file),
            viewFieldFile($spouse, 'work_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->work_file),
            viewFieldFile($spouse, 'unemployment_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->unemployment_file),
            viewFieldFile($spouse, 'salary_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->salary_file),

            viewFieldFile($spouse, 'personal_data_file', Yii::$app->params['module']['spouse']['filePath'] . $spouse->id . '/' . $spouse->personal_data_file),

        ],*/
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