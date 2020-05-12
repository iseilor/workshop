<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\admin\models\User;
use app\modules\user\Module;
use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">

    <div class="card-body">

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget(
            [
                'dataProvider' => $dataProvider,
                //'filterModel' => $searchModel,
                'columns' => [
                    'id',
                    'attribute' => 'created_at:datetime',
                    [
                        'class' => LinkColumn::className(),
                        'attribute' => 'fio',
                    ],
                    'email:email',
                    [
                        'class' => SetColumn::className(),
                        'filter' => User::getStatusesArray(),
                        'attribute' => 'status',
                        'name' => 'statusName',
                        'cssCLasses' => [
                            User::STATUS_ACTIVE => 'success',
                            User::STATUS_WAIT => 'warning',
                            User::STATUS_BLOCKED => 'default',
                        ],
                    ],
                    [
                        'class' => SetColumn::className(),
                        'filter' => User::getRolesArray(),
                        'attribute' => 'role_id',
                        'name' => 'roleName',
                        'cssCLasses' => [
                            User::ROLE_USER => 'success',
                            User::ROLE_MANAGER => 'warning',
                            User::ROLE_ADMIN => 'danger',
                        ],
                    ],

                    ['class' => ActionColumn::className()],
                ],
            ]
        ); ?>

        <?php Pjax::end(); ?>
    </div>
</div>
