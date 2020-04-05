<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\ChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('baby') . Module::t('child', 'My Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">

                <p>
                    <?= Html::a(Icon::show('plus') . Module::t('child', 'Create Child'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'class' => LinkColumn::className(),
                            'attribute' => 'id',
                        ],
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
                        //'file_passport',
                        //'file_registration',
                        //'file_birth',
                        //'file_address',
                        //'file_ejd',
                        //'file_personal',
                        //'is_invalid',
                        //'file_invalid',
                        //'file_posobie',
                        //'is_study',
                        //'file_study',
                        //'file_scholarship',

                        ['class' => ActionColumn::className()],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
