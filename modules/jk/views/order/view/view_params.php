<?php

use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'Номер заявки',
            'value' => $model->id,
        ],
        'created_at:datetime',
        [
            'label' => 'Статус',
            'format' => 'raw',
            'value' => $model->status->label,
        ],
        [
            'label' => 'Автор',
            'format' => 'raw',
            'value' => $model->getCreatedUserLink(),
        ],
        'updated_at:datetime',
        [
            'label' => 'Кем изменено',
            'format' => 'raw',
            'value' => $model->getUpdatedUserLink(),
        ],
        [
            'attribute' => 'is_participate',
            'label' => 'Ранее участвовали в программе',
            'value' => ($model->is_participate) ? $model->getParticipateList()[$model->is_participate] : 'Не указано',
        ],
    ],
]) ?>