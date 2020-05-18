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
                    ['name' => Icon::show('check') . 'Согласования', 'id' => 'check', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => '']
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


