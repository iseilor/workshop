<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\nsi\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\nsi\models\ColorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('palette') . Module::t('color', 'Colors');
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
                    <?= Html::a(Module::t('color', 'Create Color'), ['create'], ['class' => 'btn btn-success']) ?>
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
                        [
                            'attribute' => 'code',
                            'content' => function ($data) {
                                return Html::tag('span', $data->code, ['class' => 'badge bg-' . $data->code]);
                            },
                        ],
                        'value',
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


