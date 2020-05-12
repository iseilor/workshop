<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
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
        <div class="card">
            <div class="card-body">
                <p>
                    <?= Html::a(
                        '<i class="fas fa-plus"></i> ' . Module::t('module', 'Create Doc'),
                        ['create'],
                        ['class' => 'btn btn-success']
                    ) ?>
                </p>
                <?php Pjax::begin(); ?>
                <?= GridView::widget(
                    [
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'class' => LinkColumn::className(),
                                'attribute' => 'id'
                            ],
                            'created_at:datetime',
                            [
                                'label' => Yii::t('app','Created By'),
                                'attribute' => 'created_by',
                                'value' => 'createdUser.fio',
                            ],
                            'title',
                            'src',
                            [
                                'class' => ActionColumn::className(),
                            ]
                        ]
                    ]
                ); ?>
                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>



