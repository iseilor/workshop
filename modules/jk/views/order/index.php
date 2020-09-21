<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\models\Status;
use app\modules\jk\Module;
use kartik\export\ExportMenu;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;

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
                        'contentOptions' => ['style' => 'max-width: 10px;'],
                        'headerOptions' => ['style' => 'width: 10px;!important'],
                    ],
                    'created_at:datetime',
                    'createdUserLabel:html',
                    [
                        'filter' => \app\modules\jk\models\Order::getTypesArray(),
                        'attribute' => 'type',
                        'value' => 'typeName',
                    ],
                    [
                        'filter' => ArrayHelper::map(Status::find()->all(), 'id', 'title'),
                        'attribute' => 'statusName',
                        'value' => 'status.label',
                        'format' => 'html',
                    ],

                    [
                        'label' => 'Прогресс',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $status = Status::findOne($data['status_id']);
                            return $status->getProgressBar();
                        },
                    ],
                    [
                            // Кнопка только если в статусе ПРОВЕРКА КУРАТОРОМ
                        'class' => ActionColumn::class,
                        'controller' => '/jk/order',
                        'template' => '{check} {commission} {view} {update} {delete}',
                        'headerOptions' => ['style' => 'min-width: 170px;'],
                        'buttons' => [
                            'check' => function ($url, $model, $key) {
                                if ($model->status->code == 'CURATOR_CHECK') {
                                    return Html::a(Icon::show('check'), $url, [
                                        'class' => 'btn btn-sm btn-success',
                                        'title' => 'Проверить заявку',
                                        'data-pjax' => '0',
                                    ]);
                                } else {
                                    return '';
                                }
                            },
                            'commission' => function ($url, $model, $key) {
                                if ($model->status->code == 'COMMISSION_WAIT') {
                                    return Html::a(Icon::show('check-double'), $url, [
                                        'class' => 'btn btn-sm btn-success',
                                        'title' => 'Жилищная комиссия',
                                        'data-pjax' => '0',
                                    ]);
                                } else {
                                    return '';
                                }
                            },
                        ],
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
                    'tableOptions' => [
                        'class' => 'table table-striped projects',
                        'style' => 'margin-bottom: 0',
                    ],
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


