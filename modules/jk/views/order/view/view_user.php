<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$user = $model->createdUser;
$passport = $user->passport;

$passportNumber = $user->passport_number;
$passportNumberLength = mb_strlen($passportNumber);
if ($passportNumberLength < 6) {
    for ($i = 0; $i < 6 - $passportNumberLength; $i++) {
        $passportNumber = '0' . $passportNumber;
    }
}

$attr = [
    [
        'label' => 'ID сотрудника',
        'value' => $user->id,
    ],
    'tab_number',
    [
        'label' => 'ФИО',
        'format' => 'raw',
        'value' => $model->getCreatedUserLink(),
    ],
    [
        'label' => $user->attributeLabels()['gender'],
        'value' => User::getGenderName($user->gender)
    ],
    'birth_date:date',
    'position',
    'work_department_full',
    'work_address',
    'experience',
    [
        'label' => 'Паспорт',
        'format' => 'raw',
        'value' =>
            $user->passport_series . ' ' . $passportNumber . '; ' .
            'Выдан: ' . $user->passport_department . '; ' .
            'Код подразделения: ' . $user->passport_code . '; ' .
            'Дата выдачи: ' . date('d.m.Y',$user->passport_date) . '; ' .
            'Адрес регистрации: ' . $user->passport_registration . ';<br/>' .
            Html::a(
                Icon::show('file-pdf') . $user->attributeLabels()['passport_file'],
                Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $user->passport_file]),
                ['target' => '_blank']),
    ],
    [
        'attribute' => 'work_is_young',
        'value'=>function($data){
            return (isset($data->work_is_young) && $data->work_is_young) ? 'Да' : 'Нет';
        }
    ],
    [
        'attribute' => 'work_is_transferred',
        'value'=>function($data){
            return (isset($data->work_is_transferred) && $data->work_is_transferred) ? 'Да' : 'Нет';
        }
    ],
];

if ($user->work_is_transferred) {
    $attr[] = [
        'label' => ' Заявление о переводе (вложение)',
        'format' => 'raw',
        'value' => ($user->work_transferred_file) ? Html::a(
            Icon::show('file-pdf') . $user->attributeLabels()['work_transferred_file'],
            Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $user->work_transferred_file]),
            ['target' => '_blank']) : '',
    ];
}
$attr[] = [
    'label' => 'Малоимущий',
    'value'=> ($model->is_poor)? 'Да' : 'Нет'
];
if ($model->is_poor) {
    $attr[] = [
        'label' => 'Справка из социальной защиты (вложение)',
        'format' => 'raw',
        'value' => ($model->file_social_protection) ? Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()['file_social_protection'],
            Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_social_protection]),
            ['target' => '_blank']) : '',
    ];
}
$attr[] = [
    'label' => 'Находится в декретном отпуске',
    'value'=> ($model->is_do)? 'Да' : 'Нет'
];
$attr[] = [
    'label' => 'Ранее участвовали в программе',
    'value' => $model->getParticipateList()[$model->is_participate]
];
if ($passport->ejd_file) {
    $attr[] = [
        'label' => 'Единый жилищный документ (вложение)',
        'format' => 'raw',
        'value' => ($passport->ejd_file) ? Html::a(
            Icon::show('file-pdf') . $passport->attributeLabels()['ejd_file'],
            Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $passport->ejd_file]),
            ['target' => '_blank']) : '',
    ];
}
$attr[] = [
    'label' => 'Наличие временной регистрации',
    'value'=> ($passport->is_temporary_registered)? 'Да' : 'Нет'
];
if ($passport->is_temporary_registered) {
    $attr[] = [
        'label' => 'Документ о временной регистрации (вложение)',
        'format' => 'raw',
        'value' => ($passport->temporary_registration_file) ? Html::a(
            Icon::show('file-pdf') . $passport->attributeLabels()['temporary_registration_file'],
            Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $passport->temporary_registration_file]),
            ['target' => '_blank']) : '',
    ];
}
$attr[] = [
    'label' => 'Адрес фактического места проживания семьи',
    'value' => $model->family_address
];
$attr[] = [
    'label' => 'Тип жилого помещения',
    'value' => $model->getJpTypeList()[$model->jp_type]
];
if ($model->jp_type == 2) {
    $attr[] = [
        'label' => 'Количество комнат',
        'value' => $model->jp_room_count
    ];
}
$attr[] = [
    'label' => 'Собственность',
    'value' => $model->getResidentOwnTypeList()[$model->resident_own_type]
];
if ($model->resident_own_type == 3) {
    $attr[] = [
        'label' => 'Договор аренды (вложение)',
        'format' => 'raw',
        'value' => ($model->file_rent) ? Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()['file_rent'],
            Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_rent]),
            ['target' => '_blank']) : '',
    ];
} elseif ($model->resident_own_type == 4) {
    $attr[] = [
        'label' => 'Договор найма (вложение)',
        'format' => 'raw',
        'value' => ($model->file_social_contract) ? Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()['file_social_contract'],
            Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_social_contract]),
            ['target' => '_blank']) : '',
    ];//viewFieldFile($model, 'file_social_contract', Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_social_contract);
}
$attr[] = [
    'label' => 'Количество проживающих',
    'value' => $model->resident_count
];
if ($model->resident_count > 1) {
    $attr[] = [
        'label' => 'Категория проживающих',
        'value' => $model->getResidentTypeList()[$model->resident_type]
    ];
}
$attr[] = [
    'label' => 'Общая площадь, м2',
    'value' => $model->jp_area
];
?>
<?= DetailView::widget([
    'model' => $user,
    'attributes' => $attr,
]) ?>