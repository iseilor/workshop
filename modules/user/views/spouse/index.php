<?php

use app\components\grid\LinkColumn;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\SpouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('spouse', 'Spouses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="spouse-index">

    <p>
        <?= Html::a(Icon::show('plus').Module::t('spouse', 'Create Spouse'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => LinkColumn::class,
                'attribute' => 'id',
            ],
            [
                'class' => LinkColumn::class,
                'attribute' => 'fio',
            ],
            'user_id',
            'gender',
            'date:date',
            'passport_file',
            'personal_data_file',
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
