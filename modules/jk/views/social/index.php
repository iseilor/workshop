<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\SocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('social', 'Socials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-index">


    <p>
        <?= Html::a(Module::t('social', 'Create Social'), ['create'], ['class' => 'btn btn-success']) ?>
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
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',
            //'deleted_at',
            //'deleted_by',
            [
                'class' => LinkColumn::class,
                'attribute' => 'title',
            ],
            'description:ntext',

            [
                'class' => ActionColumn::class,
                'visible' => Yii::$app->user->can('curator_mrf'),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
