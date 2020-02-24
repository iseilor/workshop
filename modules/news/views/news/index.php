<?php

use app\components\grid\ActionColumn;
use app\modules\news\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <p>
        <?= Html::a(Module::t('module', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'created_at',
            'created_by',
            'title',
            'img',
            'description:ntext',
            //'annotation:ntext',
            //'text:ntext',
            [
                'class' => ActionColumn::className(),
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
