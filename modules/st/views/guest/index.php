<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\st\models\GuestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Guests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="guest-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Guest'), ['create'], ['class' => 'btn btn-success']) ?>
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
            //'curator_id',
            //'guest_fio',
            //'guest_category',
            //'guest_photo',
            //'date',
            //'title',
            //'annotation:ntext',
            //'text:ntext',
            //'registration_link',
            //'webinar_link',
            //'youtube_link',
            //'vk_link',
            //'telegram_link',
            //'video',
            //'weight',
            //'icon',
            //'color',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
