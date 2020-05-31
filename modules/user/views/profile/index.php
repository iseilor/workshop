<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\ChildSearch;
use app\modules\user\Module;
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

$this->title = Module::t('module', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <div class="card card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <?= Html::img($model->photo, ['alt' => $model->fio, 'class' => 'profile-user-img img-fluid img-circle']) ?>
                </div>
                <h3 class="profile-username text-center"><?= $model->fio; ?></h3>
                <p class="text-muted text-center"><?= $model->position; ?></p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>ID</b> <a class="float-right"><?= Yii::$app->user->identity->id ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Табельный номер</b> <a class="float-right"><?= $model->tab_number ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Дата рождения</b> <a class="float-right"><?= Yii::$app->formatter->format($model->birth_date, 'date'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Пол</b> <a class="float-right"><?= $model->gender; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?= $model->email; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Телефон</b> <a class="float-right"><?= $model->work_phone; ?></a>
                    </li>
                    <!--<li class="list-group-item">
                        <b>Дата трудоустройства</b> <a class="float-right"><?= Yii::$app->formatter->format($model->work_date, 'date'); ?></a>
                    </li>-->
                    <li class="list-group-item">
                        <b>Стаж, полных лет</b> <a class="float-right"><?= $experience ?></a>
                    </li>
                </ul>
                <?= Html::a(
                    '<i class="fas fa-user-edit"></i> ' . Module::t('module', 'Profile Update'),
                    ['update'],
                    [
                        'class' => 'btn 
        btn-info',
                    ]
                ) ?>
            </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
            <div class="card-header p-0 border-bottom-0">
                <?php
                $tabs = [
                    ['name' => Icon::show('female') . 'Супруг(а)', 'id' => 'spouse', 'tab-class' => 'active', 'selected' => true, 'tabs-class' => 'show active'],
                    ['name' => Icon::show('baby') . 'Дети', 'id' => 'child', 'tab-class' => '', 'selected' => false, 'tabs-class' => ''],
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
                            <?= $this->render('index/profile_' . $tab['id']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


