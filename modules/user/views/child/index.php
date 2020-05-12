<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\ChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('baby') . Module::t('child', 'My Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <p>
                    <?= Html::a(Icon::show('plus') . Module::t('child', 'Create Child'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => LinkColumn::class,
                            'attribute' => 'id',
                        ],
                        [
                            'class' => LinkColumn::class,
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
                        [
                            'attribute' => 'is_invalid',
                            'content'=>function($data){
                                return (isset($data->is_invalid) && $data->is_invalid) ? '<span class="badge badge-danger">Да</span>' : 'Нет';
                            }
                        ],
                        [
                            'attribute' => 'is_study',
                            'content'=>function($data){
                                return (isset($data->is_study) && $data->is_study) ? '<span class="badge badge-info">Да</span>' : 'Нет';
                            }
                        ],
                        'passportLink:raw',
                        'birthLink:raw',
                        'personalLink:raw',
                        ['class' => ActionColumn::class],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
