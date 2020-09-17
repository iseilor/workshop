<?php

use app\components\grid\LinkColumn;
use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\CuratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('user-graduate').Module::t('curator', 'Curators');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').Module::t('module','admin'), 'url' => ['/kr/admin/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curator-index">
    <p>
        <?= Html::a(Icon::show('plus').Module::t('curator', 'Create Curator'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'img',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img(Url::home() . Yii::$app->params['module']['kr']['curator']['path'] . $data->img, [
                        'class' => "img-circle img-fluid",
                        'style' => 'width: 100px',

                    ]);
                },
            ],
            [
                'class' => LinkColumn::class,
                'attribute' => 'fio',
            ],
            'position',
            'phone',
            'email:ntext',
            'weight',
            //'block_id',
            ['class' => \app\components\grid\ActionColumn::class],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
