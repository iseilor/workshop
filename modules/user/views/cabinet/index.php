<?php

use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $percentDataProvider yii\data\ActiveDataProvider */
/* @var $zaimDataProvider yii\data\ActiveDataProvider */
/* @var $orderDataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('briefcase').'Мой кабинет';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
            <div class="card-header p-0 border-bottom-0">
                <?php
                $tabs = [
                    ['name' => Icon::show('percent') . 'Проценты', 'id' => 'percent', 'tab-class' => 'active', 'selected' => 'true', 'tabs-class' => 'show active'],
                    ['name' => Icon::show('wallet') . 'Займы', 'id' => 'zaim', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => 'show'],
                    ['name' => Icon::show('ruble-sign') . 'Заявки', 'id' => 'order', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => 'show '],
                    ['name' => Icon::show('check') . 'Согласования', 'id' => 'check', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    /*['name' => Icon::show('female') . 'Супруг(а)', 'id' => 'spouse', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    ['name' => Icon::show('baby') . 'Дети', 'id' => 'child', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    ['name' => Icon::show('users') . 'Семья', 'id' => 'family', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    ['name' => Icon::show('home') . 'ЖП', 'id' => 'house', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    ['name' => Icon::show('file-invoice-dollar') . 'Ипотека', 'id' => 'ipoteka', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                    ['name' => Icon::show('ruble-sign') . 'Финансы', 'id' => 'money', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],*/
                ];
                echo Html::ul($tabs, [
                    'item' => function ($item, $index) {
                        return Html::tag(
                            'li',
                            Html::a($item['name'], '#tabs-' . $item['id'], [
                                'class' => 'nav-link ' . $item['tab-class'],
                                'id' => 'tab-' . $item['id'],
                                'data-toggle' => 'pill',
                                'role' => 'tab',
                                'aria-controls' => 'tabs-' . $item['id'],
                                'aria-selected' => $item['selected'],
                            ]),
                            ['class' => 'nav-item']
                        );
                    },
                    'class' => 'nav nav-tabs',
                    'id' => 'custom-tabs-three-tab',
                    'role' => 'tablist',
                ]) ?>
                <!--<ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1">
                            <?= Yii::$app->params['module']['jk']['percent']['icon'] ?> Проценты</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2"
                           aria-selected="true">
                            <?= Yii::$app->params['module']['jk']['zaim']['icon'] ?> Займы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3"
                           aria-selected="true">
                            <?= Yii::$app->params['module']['jk']['order']['icon'] ?> Заявки
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4"
                           aria-selected="true">
                            <?= \kartik\icons\Icon::show('baby') ?>Дети
                        </a>
                    </li>
                </ul>-->
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <?php foreach ($tabs as $tab): ?>
                        <div class="tab-pane fade <?= $tab['tabs-class'] ?>" id="tabs-<?= $tab['id'] ?>" role="tabpanel" aria-labelledby="tab-<?= $tab['id'] ?>">
                            <?= $this->render( $tab['id'],['dataProvider'=>$dataProvider,'searchModel'=>$searchModel]) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


