<?php

use app\components\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Socials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create User Social'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'created_by',
            'title',
            'description:ntext',
            ['class' => ActionColumn::className()],
        ],
    ]); ?>


</div>
