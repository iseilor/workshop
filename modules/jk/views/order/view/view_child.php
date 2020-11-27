<?php

use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use yii\grid\GridView;
use yii\helpers\Url;

$searchModel = new ChildSearch(['user_id' => $model->created_by]);
$dataProvider = $searchModel->search([]);
$dataProvider->query->andWhere(['deleted_at' => null]);

?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::class,
            'attribute' => 'fio',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        'date:date',
        'age',
        'passportLink:html',
        'birthLink:html',
        'personalLink:html',
        [
            'attribute' => 'is_invalid',
            'content'=>function($data){
                return (isset($data->is_invalid) && $data->is_invalid) ? '<span class="badge badge-danger">Да</span>' : 'Нет';
            }
        ],
        [
            'attribute' => 'is_study',
            'content'=>function($data){
                return (isset($data->is_study) && $data->is_study) ? '<span class="badge badge-info">Да</span>' : 'Нет';
            }
        ],
    ],
]); ?>