<?php

use app\modules\jk\Module;
use yii\widgets\ListView;

$this->title = $this->context->icon . ' ' . Module::t('module', 'Docs');
$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = $this->title;

echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'index_item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row'
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-md-6',
        ],
    ]
);