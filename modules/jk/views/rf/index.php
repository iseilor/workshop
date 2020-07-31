<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\RfSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('sitemap').Module::t('rf', 'RFs');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').'ЖК', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').'Админка', 'url' => ['/jk/admin/']];
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
                        'title',
                        'user_id',
                        'email:email',
                        'phone',
                        'address',
                        'coefficient',
                        'percent_max',
                        'loan_max',
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






