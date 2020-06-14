<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\bot\models\BotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bot-index">
    <p>
        <?= Html::a(Yii::t('app', 'Create Bot'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => LinkColumn::class,
                'attribute' => 'id',
            ],
            [
                'class' => LinkColumn::class,
                'attribute' => 'title',
            ],
            [
                'class' => LinkColumn::class,
                'attribute' => 'title_link',
            ],
            //'description:ntext',
            //'text:ntext',
            'img',
            'icon',
            'bot_id',
            [
                'class' => ActionColumn::class,
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
