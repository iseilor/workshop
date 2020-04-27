<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\controllers\UserController;
use app\modules\user\models\ChildSearch;
use app\modules\user\models\User;
use app\modules\user\Module;


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
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
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
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                        <h3>Ваши предварительные расчёты по сумме компенсации процентов</h3>
                        <?= GridView::widget(
                            [
                                'dataProvider' => $percentDataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => LinkColumn::className(),
                                        'attribute' => 'id',
                                        'url' => function ($data) {
                                            return Url::to(['/jk/percent/' . $data->id]);
                                        },
                                    ],
                                    'created_at:datetime',
                                    'compensation_count:decimal',
                                    'compensation_years',
                                    [
                                        'class' => ActionColumn::className(),
                                        'controller' => '/jk/percent',
                                    ],
                                ],
                            ]
                        ) ?>
                    </div>
                    <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                        <h3>Ваши предвартельные расчёты по сумме займа</h3>
                        <?= GridView::widget(
                            [
                                'dataProvider' => $zaimDataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => LinkColumn::className(),
                                        'attribute' => 'id',
                                        'url' => function ($data) {
                                            return Url::to(['/jk/zaim/' . $data->id]);
                                        },
                                    ],
                                    'created_at:datetime',
                                    'compensation_count:decimal',
                                    'compensation_years',
                                    [
                                        'class' => ActionColumn::className(),
                                        'controller' => '/jk/zaim',
                                    ],
                                ],
                            ]
                        ) ?>
                    </div>
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                        <?= $this->render('index_order', ['orderDataProvider' => $orderDataProvider]) ?>
                    </div>
                    <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                        <?php
                        $searchModel = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
                        $dataProvider = $searchModel->search([]);
                        echo $this->render('@app/modules/user/views/child/grid-view', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


