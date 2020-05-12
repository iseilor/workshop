<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use app\modules\jk\models\Stop;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\StopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отказы сотрудников от материальной помощи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card  card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">

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
                        'created_at:datetime',
                        'createdUserLink:html',
                        [
                            'attribute' => 'order_id',
                            'value' => 'orderLink',
                            'format'=>'html'
                        ],
                        [
                            'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'title'),
                            'attribute' => 'stopStatusId',
                            'value' => 'stop.status.title',
                        ],
                        [
                            'filter' => ArrayHelper::map(Stop::find()->all(), 'id', 'title'),
                            'attribute' => 'stop_id',
                            'value' => 'stop.title',
                        ],
                        'comment',
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
