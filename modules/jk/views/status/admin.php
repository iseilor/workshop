<?php

use app\components\grid\ActionColumn;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\StatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('list') . Module::t('module', 'Order Statuses');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . Module::t('module', 'JK'), 'url' => ['/jk/']];
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
                    <?= Html::a(Icon::show('plus') . Module::t('module', 'Create Order Status'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        [
                            'attribute' => 'title',
                            'value' => 'label',
                            'format' => 'html',
                        ],
                        'code',
                        [
                            'label' => 'Прогресс',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return $data->getProgressBar();
                            },
                        ],
                        [
                            'label' => 'Изменить',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return ($data->is_edit) ? Html::tag('span', 'ДА', ['class' => 'badge badge-success'])
                                    : Html::tag('span', 'НЕТ', ['class' => 'badge badge-danger']);
                            },
                        ],
                        [
                            'label' => 'Отменить',
                            'format' => 'raw',
                            'value' => function ($data) {
                                return ($data->is_cancel) ? Html::tag('span', 'ДА', ['class' => 'badge badge-success'])
                                    : Html::tag('span', 'НЕТ', ['class' => 'badge badge-danger']);
                            },
                        ],
                        'weight',
                        [
                            'class' => ActionColumn::class,
                            'visible' => Yii::$app->user->can('curator_mrf'),
                        ],
                    ],
                ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>