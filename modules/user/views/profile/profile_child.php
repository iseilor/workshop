<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\models\ChildSearch;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<h3>Мои дети</h3>
<p>
    <?= Html::a(Icon::show('plus') . Module::t('child', 'Create Child'), ['child/create'], ['class' => 'btn btn-success']) ?>
</p>

<?php

// Дети текущего пользователя
$childSearch = new ChildSearch(['user_id'=>Yii::$app->user->identity->id]);
$dataProvider = $childSearch->search([]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::className(),
            'attribute' => 'id',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        [
            'class' => LinkColumn::className(),
            'attribute' => 'fio',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        'date:date',
        'age',
        [
            'class' => ActionColumn::className(),
            'controller' => '/user/child',
        ],
    ],
]);
?>

