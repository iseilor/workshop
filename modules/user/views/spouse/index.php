<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\SpouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Spouses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spouse-index">

    <p>
        <?= Html::a(Yii::t('app', 'Create Spouse'), ['create'], ['class' => 'btn btn-success']) ?>
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
            //'user_id',
            //'fio',
            //'gender',
            //'date',
            //'passport_series',
            //'passport_number',
            //'passport_date',
            //'passport_department',
            //'passport_code',
            //'passport_file',
            //'agree_personal_data',
            //'agree_personal_data_file',
            //'edj',
            //'edj_file',
            //'is_work',
            //'is_rtk',
            //'is_do',
            //'marriage_file',
            //'registration_file',
            //'explanatory_note_file',
            //'work_file',
            //'unemployment_file',
            //'salary_file',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
