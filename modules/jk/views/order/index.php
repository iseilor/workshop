<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\nsi\models\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->context->icon . ' ' . Module::t('module', 'Orders');
$this->params['breadcrumbs'][] = $this->context->parent;
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
                <?php

                $gridColumns = [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => LinkColumn::class,
                        'attribute' => 'id',
                    ],
                    'created_at:datetime',
                    [
                        'filter' => \app\modules\jk\models\Order::getTypesArray(),
                        'attribute' => 'type',
                        'value' => 'typeName',
                    ],
                     [
                        'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'title'),
                        'attribute' => 'statusName',
                    ],



                    'createdUser.fio',
                    [
                        'class' => ActionColumn::class,
                    ],
                ];
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                ]);

                Pjax::begin(['timeout' => false]);
                echo \kartik\grid\GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
                ]);
                Pjax::end();
                ?>
            </div>
            <div class="card-footer">
                <a class="btn btn-default float-right" href="/jk/zaim/create">Обновить таблицу</a>
            </div>
        </div>
    </div>
</div>


