<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

$user = $model->createdUser;
?>
<?= DetailView::widget([
    'model' => $user,
    'attributes' => [
        [
            'label' => 'ID сотрудника',
            'value' => $user->id,
        ],
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
                $user->passport_series . ' ' . $user->passport_number . '; ' .
                'Выдан: ' . $user->passport_department . '; ' .
                'Код подразделения: ' . $user->passport_code . '; ' .
                'Дата выдачи: ' . date('d.m.Y',$user->passport_date) . '; ' .
                'Адрес регистрации: ' . $user->passport_registration . ';<br/>' .
                Html::a(
                    Icon::show('file-pdf') . $user->attributeLabels()['passport_file'],
                    Url::to(['/' . Yii::$app->params['module']['user']['path'] . $user->id . '/' . $user->passport_file]),
                    ['target' => '_blank']),
        ],
    ],
]) ?>