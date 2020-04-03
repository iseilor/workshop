<?php

use yii\widgets\DetailView;

$user =  $model->createdUser;
?>
<?= DetailView::widget([
    'model' => $user,
    'attributes' => [
        [
            'label'=>'ID сотрудника',
            'value'=>$user->id
        ],
        [
            'label' => 'ФИО',
            'format' => 'raw',
            'value' => $model->getCreatedUserLink(),
        ],
        'gender',
        'birth_date:date',
        'position',
        'work_department_full',
        'work_address',
        'experience',
        [
            'label'=>'Паспорт',
            'value'=>'123'
        ]
    ],
]) ?>