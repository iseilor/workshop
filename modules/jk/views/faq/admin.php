<?php

use app\components\grid\ActionColumn;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('question') . Module::t('faq', 'FAQ');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . Module::t('module', 'JK'), 'url' => ['/jk/']];
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

                <p>
                    <?= Html::a(Icon::show('plus') . Module::t('faq', 'Create Faq'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>

                <?php Pjax::begin(); ?>


                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'parent.question',
                        'weight',
                        'question',
                        'answer:html',
                        ['class' => ActionColumn::class],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>


