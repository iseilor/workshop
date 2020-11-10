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

\app\modules\jk\assets\JkOrderAsset::register($this);
?>


<div class="row">
    <div class="col-md-12">
        <div class="card  card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">

                <a href="order/excel" class="btn btn-success"><?=Icon::show('file-excel')?>Выгрузить реестр</a>
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
                        'template' => '{manager} {2curator} {check} {commission} {doc} {view} {update}  {delete}',
                        'headerOptions' => ['style' => 'min-width: 210px;'],
                        'buttons' => [
                            // Отправить принудительно на проверку куратору
                            '2curator' => function ($url, $model, $key) {
                                if ($model->status->code == 'MANAGER_WAIT') {
                                    return Html::a(Icon::show('user-check'), $url, [
                                        'class' => 'btn btn-sm bg-purple',
                                        'title' => 'На проверку куратору',
                                        'data-pjax' => '0',
                                        'style'=>'width: 35px;'
                                    ]);
                                } else {
                                    return '';
                                }
                            },

                            // Кнопка повторной отправки письма руководителю, если заявка находится в статусе "Согласование руководителями"
                            'manager' => function ($url, $model, $key) {
                                if ($model->status->code == 'MANAGER_WAIT') {
                                    return Html::a(Icon::show('envelope'), $url, [
                                        'class' => 'btn btn-sm btn-warning btn-manager',
                                        'title' => 'Отправить повторное уведомление руководителю',
                                        'data-pjax' => '0',
                                    ]);
                                } else {
                                    return '';
                                }
                            },

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

                            // Оформление документов
                            'doc' => function ($url, $model, $key) {
                                if ($model->status->code == 'DOC') {
                                    return Html::a(Icon::show('file-word'), $url, [
                                        'class' => 'btn btn-sm bg-purple',
                                        'title' => 'Оформление документов',
                                        'data-pjax' => '0',
                                        'style'=>'width: 35px;'
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

            </div>
        </div>
    </div>
</div>

<?php


//во вьюхе
//$this->registerJsFile('path/to/myfile');
