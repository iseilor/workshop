<?php

use app\components\grid\ActionColumn;
use app\modules\jk\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\MinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->title = '<i class="fas fa-wallet"></i> ' . Module::t('module', 'Mins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <p>
                    <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?= GridView::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            'id',
                            'title',
                            'min:decimal',
                            'description:ntext',
                            [
                                    'class' => ActionColumn::class,
                                    'visible' => Yii::$app->user->can('curator_rf'),
                            ],
                        ],
                    ]
                ); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>