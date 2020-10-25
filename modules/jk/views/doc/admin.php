<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\DocSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->context->icon . ' ' . Module::t('module', 'Docs');
$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <p>
                    <?= Html::a(
                        Icon::show('plus') . Module::t('module', 'Create Doc'),
                        ['create'],
                        ['class' => 'btn btn-success']
                    ) ?>
                </p>
                <?php Pjax::begin(); ?>
                <?= GridView::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'pager' => [
                            'class' => 'app\widgets\LinkPager',
                        ],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => LinkColumn::class,
                                'attribute' => 'id'
                            ],
                            'created_at:datetime',
                            'weight',
                            'createdUserLink:html',
                            'title',
                            'filePathLink:raw',
                            [
                                'class' => ActionColumn::class,
                            ]
                        ]
                    ]
                ); ?>
                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>



