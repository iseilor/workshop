<?php

use app\components\grid\ActionColumn;
use app\modules\jk\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '<i class="fas fa-question"></i> '.Module::t('module', 'Faqs');
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-body">

                <p>
                    <?= Html::a('<i class="fas fa-plus"></i> '.Module::t('module', 'Create Faq'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>
                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                                         'dataProvider' => $dataProvider,
                                         'filterModel' => $searchModel,
                                         'columns' => [
                                             ['class' => 'yii\grid\SerialColumn'],
                                             'id',
                                             //'created_at:datetime',
                                             //'created_by',
                                             //'updated_at',
                                             //'updated_by',
                                             //'deleted_at',
                                             //'deleted_by',
                                             'question',
                                             'answer:ntext',
                                             ['class' => ActionColumn::className()],
                                         ],
                                     ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>


