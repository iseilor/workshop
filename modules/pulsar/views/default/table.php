<?php

use app\components\grid\Value5Column;
use app\modules\pulsar\Module;
use kartik\icons\Icon;
use yii\grid\GridView;


/* @var $userDataProvider \yii\data\ActiveDataProvider */

$this->title = Icon::show('table') . 'Пульсары. Таблица';
$this->params['breadcrumbs'][] = [
    'label' => Icon::show('heartbeat') . Module::t('module', 'Pulsars'),
    'url' => ['index'],
];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= Icon::show('table') ?>Сводный отчёт за <?= date('d.m.Y') ?></h3>
            </div>
            <div class="card-body">
                <?= GridView::widget([
                    'dataProvider' => $userDataProvider,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'fio',
                        'pulsar.created_at:datetime',
                        [
                            'class' => Value5Column::class,
                            'attribute' => 'pulsar.health_value',
                        ],
                        [
                            'class' => Value5Column::class,
                            'attribute' => 'pulsar.mood_value',
                        ],
                        [
                            'class' => Value5Column::class,
                            'attribute' => 'pulsar.job_value',
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

