<?php

use app\modules\jk\models\Order;
use yii\widgets\DetailView;

?>
    <!--'jp_type' => $this->integer(),            // Тип жилого помещения
    'jp_params' => $this->text(),             // Параметры жилого помещения
    'jp_date' => $this->integer(),            // Дата сдачи жилого помещения
    'jp_dist' => $this->integer(),            // Расстояние до рабочего места
    'jp_own' => $this->integer(),             // Тип собственности жилого помещения
    'jp_part'=>$this->text(),
    -->
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => $model->attributeLabels()['jp_type'],
            'value' => $model::getJPTypeName($model->jp_type),
        ],
        'jp_params',
        'jp_date:date',
        [
            'label' => $model->attributeLabels()['jp_own'],
            'value' => $model::getJPOwnName($model->jp_own),
        ],
        'jp_part',
        'jp_dist',
        /*[
            'label' => 'Номер заявки',
            'value' => $model->id,
        ],
        'created_at:datetime',
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
        ],*/
    ],
]) ?>