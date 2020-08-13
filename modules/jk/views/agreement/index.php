<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\jk\models\AgreementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('agreement', 'Agreements');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').'Жилищная Программа', 'url' => Url::to(['/jk'],true)];
$this->params['breadcrumbs'][] = $this->title;
?>




    <p>
        <?= Html::a(Module::t('agreement', 'Create Agreement'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            //'deleted_at',
            //'deleted_by',
            //'order_id',
            //'user_id:ntext',
            //'receipt_at',
            //'approval_at',
            //'comment:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
