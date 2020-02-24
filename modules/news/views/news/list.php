<?php
/* @var $dataProvider yii\data\ActiveDataProvider */

use app\modules\news\Module;
use yii\widgets\ListView;

$icon = Yii::$app->params['module']['news']['icon'];
$this->title = $icon .' '.Module::t('module', 'News');
$this->params['breadcrumbs'][] = $this->title;


echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'list_item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row'
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-md-12',
        ],
    ]
);
