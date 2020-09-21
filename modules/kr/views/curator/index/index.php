<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\CuratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('user-graduate').'Кураторы и тренеры проекта';
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = $this->title;

echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row d-flex align-items-stretch'
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-12 col-sm-6 col-md-4',
        ],
    ]
);