<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\OrderStopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => 'ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/jk/admin']];
$this->title = Module::t('stop', 'Stops');
$this->params['breadcrumbs'][] = $this->title;

$orderStatuses = Status::find()->all();
$orderStatuses = ArrayHelper::map($orderStatuses, 'id', 'title');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <p>
                    <?= Html::a(Icon::show('plus') . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => LinkColumn::className(),
                            'attribute' => 'id',
                        ],
                        //'created_at:datetime',
                        /*[
                            'class' => LinkColumn::className(),
                            'label' => Yii::t('app', 'Created By'),
                            'attribute' => 'created_by',
                            'value' => 'createdUser.fio',
                            'url' => function ($data) {
                                return Url::to(['/user/'.$data->created_by ]);
                            },
                        ],*/
                        [
                            'class' => LinkColumn::className(),
                            'attribute' => 'title',
                        ],
                        [
                            'attribute' => 'order_status_id',
                            'filter' => $orderStatuses,
                            'content' => function ($data) {
                                return $data->orderStatus['title'];
                            },
                        ],
                        [
                            'class' => ActionColumn::className(),
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

