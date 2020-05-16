<?php

use app\modules\jk\models\Order;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
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
        'typeName',
        [
            'label'=>'Калькулятор',
            'format' => 'raw',
            'value'  => function ($data) {
                if ($data->type==Order::TYPE_PERCENT && $data->percent_id){
                    return Html::a('Проценты №'.$data->percent_id,Url::to(['/jk/percent/update','id'=>$data->percent_id],true));
                }

            }
        ],
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
        [
            'label' => $model->attributeLabels()['is_agree_personal_data'],
            'format' => 'raw',
            'value' => ($model->is_agree_personal_data) ? '<span class="badge bg-green">Получено</span>':'<span class="badge bg-red">Не получено</span>'
        ],
        [
            'label' => $model->attributeLabels()['file_agree_personal_data'],
            'format' => 'raw',
            'value' => ($model->file_agree_personal_data) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['file_agree_personal_data'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_agree_personal_data]),
                ['target' => '_blank']) : '',
        ],
        [
            'attribute' => 'participateLabel',
            'format' => 'raw',
            'label' => 'Ранее участвовали в программе',
        ],
        [
            'attribute' => 'is_mortgage',
            'value'=>($model->is_mortgage)?'Да':'Нет'
        ],
        'updated_at:datetime',
        [
            'label' => 'Кем изменено',
            'format' => 'raw',
            'value' => $model->getUpdatedUserLink(),
        ],
    ],
]) ?>