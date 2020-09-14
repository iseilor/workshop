<?php

use app\modules\st\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\st\models\CuratorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('star') . Module::t('module', 'st');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary active" href="javascript:void(0)" data-filter="all"> <?=Icon::show('users')?>Все гости </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> <?=Icon::show('running')?>Спортсмены </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="2"> <?=Icon::show('guitar')?>Артисты </a>
                        <a class="btn btn-primary" href="javascript:void(0)" data-filter="3"> <?=Icon::show('microscope')?> Учёные </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row d-flex align-items-stretch',
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-12 col-sm-6 col-md-4 d-flex align-items-stretch',
        ],
    ]
);