<?php

use app\components\grid\ActionColumn;
use app\modules\user\Module;


use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <div class="card card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle"
                         src="<?= Url::home() ?>img/user4-128x128.jpg"
                         alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">Иванов Иван</h3>
                <p class="text-muted text-center">Программист</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right"><?= $model->email; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Телефон</b> <a class="float-right"><?= $model->phone; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Дата рождения</b> <a class="float-right"><?= Yii::$app->formatter->format($model->birth_date, 'date'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Пол</b> <a class="float-right"><?= $model->gender; ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Дата трудоустройства</b> <a class="float-right"><?= Yii::$app->formatter->format($model->work_date, 'date'); ?></a>
                    </li>
                    <li class="list-group-item">
                        <b>Стаж, полных лет</b> <a class="float-right"><?= $experience ?></a>
                    </li>
                </ul>
                <?= Html::a(
                    '<i class="fas fa-user-edit"></i> ' . Module::t('module', 'Profile Update'),
                    ['update'],
                    [
                        'class' => 'btn 
        btn-primary',
                    ]
                ) ?>
                <!--<?= Html::a(
                    '<i class="fas fa-user-lock"></i> ' . Module::t('module', 'Password Change'),
                    ['password-change'],
                    [
                        'class' => 'btn 
        btn-primary',
                    ]
                ) ?>-->

            </div>
        </div>
    </div>


    <div class="col-md-9">
        <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home">
                            <i class="fas fa-calculator nav-icon"></i> Калькуляции процентов</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile"
                           aria-selected="true">
                            <i class="fas fa-calculator nav-icon"></i> Калькуляции займов
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                        <?php Pjax::begin(); ?>
                        <?=
                        GridView::widget(
                            [
                                'dataProvider' => $percentDataProvider,
                                /*'filterModel' => $percentSearchModel,*/
                                'columns' => [
                                    [
                                        'attribute' => 'id',
                                        'value' => function ($data) {
                                            return Html::a($data->id, ['/jk/percent/view', 'id' => $data->id]);
                                        },
                                        'format' => 'raw',
                                    ],
                                    [
                                        'label' => 'Дата',
                                        'attribute' => 'created_at',
                                        'format' => ['date', 'dd.MM.Y hh:i:s'],
                                    ],
                                    [
                                        'label' => 'Максимальный размер компенсации, руб',
                                        'attribute' => 'compensation_count',
                                        'format' => ['decimal', 0, ' ']
                                    ],
                                    'compensation_years',
                                    [
                                        'class' => ActionColumn::className(),
                                        'controller' => '/jk/percent'
                                    ],
                                ],
                            ]
                        ); ?>
                        <?php Pjax::end(); ?>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                        <?php Pjax::begin(); ?>
                        <?=
                        GridView::widget(
                            [
                                'dataProvider' => $zaimDataProvider,
                                /*'filterModel' => $zaimSearchModel,*/
                                'columns' => [
                                    'id',
                                    [
                                        'label' => 'Дата',
                                        'attribute' => 'created_at',
                                        'format' => ['date', 'dd.mm.Y hh:i:s'],

                                    ],
                                    'compensation_count',
                                    'compensation_years',
                                    [
                                        'class' => ActionColumn::className(),
                                        'controller' => '/jk/percent'
                                    ],
                                ],
                            ]
                        ); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


