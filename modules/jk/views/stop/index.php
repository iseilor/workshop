<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\StopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'Жилищная Программа', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/jk/admin']];
$this->title = Module::t('stop', 'Stops');
$this->params['breadcrumbs'][] = $this->title;

$statuses = Status::find()->all();
$statuses = ArrayHelper::map($statuses, 'id', 'title');
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
                    <?= Html::a(Icon::show('plus') . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
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
                            'attribute' => 'status_id',
                            'filter' => $statuses,
                            'content' => function ($data) {
                                return $data->status->title;
                            },
                        ],
                        [
                            'class' => ActionColumn::class,
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

