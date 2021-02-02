<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\RfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('sitemap') . Module::t('rf', 'RFs');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools') . 'Админка', 'url' => ['/jk/admin/']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <p>
                    <?= Html::a(Icon::show('plus') . Module::t('rf', 'Create Rf'), ['create'], ['class' => 'btn btn-success']) ?>
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
                            'label' => 'Сотрудник',
                            'value' => 'userCurator.fio',
                            'class' => LinkColumn::class,
                            'url' => function ($data) {
                                if (isset($data->user_id)) {
                                    return Url::to(['/user/' . $data->user_id], true);
                                } else {
                                    return false;
                                }
                            },
                        ],
                        'email:email',
                        'header',
                        //'phone',
                        //'address',
                        //'coefficient:decimal',
                        //'percent_max:currency',
                        //'loan_max:currency',
                        [
                            'class' => ActionColumn::class,
                            'visible' => Yii::$app->user->can('curator_mrf'),
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>






