<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */

$this->title = Icon::show('file', ['framework' => Icon::FAR]) . 'Заявка №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => ['/module/jk']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('copy', ['framework' => Icon::FAR]) . Module::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title .= ' <span class="badge bg-success">новая</span>';
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header p-0 border-bottom-0">
                <?php
                $tabs = [
                    ['name' => Icon::show('list').'Параметры', 'id' => 'params', 'tab-class' => 'active', 'selected' => 'true', 'tabs-class'=>'show active'],
                    ['name' => Icon::show('user').'Сотрудник', 'id' => 'user', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('users').'Семья', 'id' => 'family', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('home').'ЖП', 'id' => 'house', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('file-invoice-dollar').'Ипотека', 'id' => 'ipoteka', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('ruble-sign').'Финансы', 'id' => 'money', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('tasks').'Согласования', 'id' => 'check', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
                    ['name' => Icon::show('history').'История', 'id' => 'history', 'tab-class' => '', 'selected' => 'false','tabs-class'=>''],
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
                    <?php foreach($tabs as $tab):?>
                        <div class="tab-pane fade <?=$tab['tabs-class']?>" id="tabs-<?=$tab['id']?>" role="tabpanel" aria-labelledby="tab-<?=$tab['id']?>">
                            <?= $this->render('view_'.$tab['id'], ['model' => $model]) ?>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::a(Icon::show('edit').'Изменить заявку', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Icon::show('stop').'Отозвать заявку', ['update', 'id' => $model->id], ['class' => 'btn btn-danger float-right']) ?>
            </div>
        </div>
    </div>
</div>