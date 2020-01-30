<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\Module;


use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $percentDataProvider yii\data\ActiveDataProvider */

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
                        <b>Табельный номер</b> <a class="float-right"><?= Yii::$app->user->identity->id ?></a>
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
                        <b>Телефон</b> <a class="float-right"><?= $model->phone_work; ?></a>
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
                                    ]
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
                                    ]
                                ],
                            ]
                        ) ?>
                    </div>
                    <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                        <h3>Ваши заявки по жилищной кампании</h3>
                        <?= GridView::widget(
                            [
                                'dataProvider' => $orderDataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    [
                                        'class' => LinkColumn::className(),
                                        'attribute' => 'id',
                                        'url' => function ($data) {
                                            return Url::to(['/jk/order/' . $data->id]);
                                        },
                                    ],
                                    'created_at:datetime',
                                    [
                                        'label' => 'Прогресс',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            return '<div class="progress progress-sm">
                                                            <div class="progress-bar bg-green" 
                                                            role="progressbar" 
                                                            aria-volumenow="' . $data['progress'] . '" 
                                                            aria-volumemin="0" 
                                                            aria-volumemax="100" 
                                                            style="width: ' . $data['progress'] . '%">
                                                    </div>
                                                </div>
                                                <small>
                                                    ' . $data['progress'] . '% выполнено
                                                </small>';
                                                                }
                                    ],
                                    [
                                        'label' => 'Статус',
                                        'format' => 'raw',
                                        'value' => function ($data) {
                                            $status = '<span class="badge badge-success">Проверка завершена</span>';
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
                                    [
                                        'class' => ActionColumn::className(),
                                    ]
                                ],
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


