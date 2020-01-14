<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\MinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->title = '<i class="fas fa-wallet"></i> '.Module::t('module', 'Mins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-body">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                                         'dataProvider' => $dataProvider,
                                         //'filterModel' => $searchModel,
                                         'columns' => [
                                             ['class' => 'yii\grid\SerialColumn'],
                                             'id',
                                             //'created_at',
                                             //'created_by',
                                             //'updated_at',
                                             //'updated_by',
                                             //'deleted_at',
                                             //'deleted_by',
                                             'title',
                                             'min:decimal',
                                             'description:ntext',
                                         ],
                                     ]); ?>
                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>