<?php

use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use yii\grid\GridView;
use yii\helpers\Url;

$searchModel = new ChildSearch();
$dataProvider = $searchModel->search(['user_id='.Yii::$app->user->identity->id]);
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
        [
            'attribute'=>'gender',
            'content'=>function($data){
                return Child::getGenderList()[$data->gender];
            }
        ],
        'date:date',
        'age',
        'passportLink:html',
        'birthLink:html',
        'personalDataLink:html',
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