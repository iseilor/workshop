<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\DocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/jk', 'Docs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="far fa-file-word"></i> <?=$this->title?></h3>
            </div>
            <div class="card-body">

                    <p>
                        <?= Html::a(
                            '<i class="fas fa-plus"></i> '.Yii::t('app/jk', 'Create Doc'),
                            ['create'],
                            ['class' => 'btn btn-success']
                        ) ?>
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
                                'created_at',
                                'created_by',
                                //'updated_at',
                                //'updated_by',
                                //'deleted_at',
                                //'deleted_by',
                                'title',
                                //'description:ntext',
                                //'src',

                                [

                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{view} {update} {delete}',
                                    'buttons' => [
                                        'view' => function ($url, $model) {
                                            return Html::a(
                                                '<i class="fas fa-eye"></i>',
                                                $url,
                                                [
                                                    'title' => 'Просмотр',
                                                ]
                                            );
                                        },
                                        'update' => function ($url, $model) {
                                            return Html::a(
                                                '<i class="fas fa-edit"></i>',
                                                $url,
                                                [
                                                    'title' => 'Изменить',
                                                ]
                                            );
                                        },
                                        'delete' => function ($url, $model) {
                                            return Html::a(
                                                '<i class="fas fa-trash"></i>',
                                                $url,
                                                [
                                                    'title' => 'Удалить',
                                                    'data' => [
                                                        'method' => 'post',
                                                        'confirm' => 'Are you sure you want to delete this item?',
                                                    ]
                                                ]
                                            );
                                        },
                                    ],
                                ]
                            ]
                        ]
                    ); ?>
                    <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>



