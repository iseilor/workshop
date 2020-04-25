<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\project\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\project\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('project', 'Projects');
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
                    <?= Html::a(Module::t('project', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                        ],
                        [
                            'class' => LinkColumn::class,
                            'attribute' => 'title',
                        ],
                        'img',
                        'users',
                        'status_id',
                        'progress',
                        [
                            'class' => ActionColumn::class,
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

