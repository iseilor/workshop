<?php

use app\components\grid\LinkColumn;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\ChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('users') . 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">

                <?php Pjax::begin(); ?>
                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => LinkColumn::class,
                            'attribute' => 'id',
                            'url' => function ($data) {
                                return Url::to(['/user/'.$data->id ]);
                            },
                        ],
                        [
                            'class' => LinkColumn::class,
                            'attribute' => 'fio',
                            'url' => function ($data) {
                                return Url::to(['/user/'.$data->id ]);
                            },
                        ],
                        'position',
                        'email:email',
                        'work_phone'
                        /*
                        //'created_at',
                        //'created_by',
                        //'updated_at',
                        //'updated_by',
                        //'deleted_at',
                        //'deleted_by',
                        //'user_id',
                        [
                            'class' => LinkColumn::className(),
                            'attribute' => 'fio',
                        ],
                        [
                            'attribute'=>'gender',
                            'content'=>function($data){
                                return Child::getGenderList()[$data->gender];
                            }
                        ],
                        'date:date',
                        'age',
                        'passportLink:html',
                        'birthLink:html',
                        //'file_registration',
                        //'file_address',
                        //'file_ejd',
                        //'file_personal',
                        [
                            'attribute' => 'is_invalid',
                            'content'=>function($data){
                                return (isset($data->is_invalid) && $data->is_invalid) ? '<span class="badge badge-danger">Да</span>' : 'Нет';
                            }
                        ],
                        //'file_invalid',
                        //'file_posobie',
                        [
                            'attribute' => 'is_study',
                            'content'=>function($data){
                                return (isset($data->is_study) && $data->is_study) ? '<span class="badge badge-info">Да</span>' : 'Нет';
                            }
                        ],
                        //'file_study',
                        //'file_scholarship',*/
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
            <div class="card-footer">
                Служебная информация
            </div>
        </div>
    </div>
</div>
