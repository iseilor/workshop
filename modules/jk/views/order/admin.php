<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $this->context->icon . ' ' . Module::t('module', 'Orders');
$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body p-0">
        <?php Pjax::begin(); ?>
        <?= GridView::widget(
            [
                'layout' => "{items}",
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table table-striped projects',
                    'style' => 'margin-bottom: 0'
                ],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => LinkColumn::className(),
                        'attribute' => 'id',
                    ],
                    [
                        'label'=>'Дата',
                        'attribute' => 'created_at',
                        'format' => 'datetime'
                    ],

                    [
                        'label'=>'Сотрудник',
                        'format' => 'raw',
                        'value' => function ($data) {


                            return '<span style="float: left; margin-right: 0.5rem;">
                                        <img alt="Avatar" class="table-avatar" src="/img/avatar.png">
                                    </span>
                                    Объедкин Алексей Валерьевич<br>
                                    <small>Инженер-программист</small>';
                        }
                    ],
                    [
                        'label' => 'Документы',
                        'format' => 'raw',
                        'value' => function () {
                            return '<ul class="list-inline">
                        <li class="list-inline-item">
                            <img alt="Avatar" class="table-avatar" src="/img/avatar.png">
                        </li>
                        <li class="list-inline-item">
                            <img alt="Avatar" class="table-avatar" src="/img/avatar.png">
                        </li>
                    </ul>';
                        }
                    ],
                    [
                        'label' => 'Прогресс',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return '<div class="progress progress-sm">
                                    <div class="progress-bar bg-green" 
                                    role="progressbar" 
                                    aria-volumenow="'.$data['progress'].'" 
                                    aria-volumemin="0" 
                                    aria-volumemax="100" 
                                    style="width: '.$data['progress'].'%">
                            </div>
                        </div>
                        <small>
                            '.$data['progress'].'% выполнено
                        </small>';
                        }
                    ],
                    [
                        'label' => 'Статус',
                        'format' => 'raw',
                        'value' => function ($data) {
                            switch ($data['status']) {
                                case 1:
                                    $status = '<span class="badge badge-success">Проверка завершена</span>';
                                    break;
                                case 2:
                                    $status = '<span class="badge badge-warning">Досыл документов</span>';
                                    break;
                                case 3:
                                    $status = '<span class="badge badge-danger">Неверные данные</span>';
                                    break;
                            }
                            return $status;
                        }
                    ],
                    ['class' => ActionColumn::className()],
                ],
            ]
        ); ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="card-footer">
        <button type="button" id="zaim-calc" class="btn btn-info" data-url="/jk/zaim/calc"><i class="fas fa-xlsx"></i> Выгрузить в XLSX-файл</button>
        <a class="btn btn-default float-right" href="/jk/zaim/create">Обновить таблицу</a>
    </div>
</div>

