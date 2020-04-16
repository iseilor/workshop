<?php

// Дети текущего пользователя
use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\ChildSearch;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$childSearch = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
$dataProvider = $childSearch->search([]);

?>

<p>
    <?= Html::a(Icon::show('plus') . Module::t('child', 'Create Child'), ['/user/child/create'], ['class' => 'btn btn-success']) ?>
</p>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::class,
            'attribute' => 'id',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        [
            'class' => LinkColumn::class,
            'attribute' => 'fio',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        'date:date',
        'age',
        [
            'class' => ActionColumn::class,
            'controller' => '/user/child',
        ],
    ],
]);