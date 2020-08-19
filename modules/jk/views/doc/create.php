<?php

use app\modules\jk\models\Doc;
use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Doc */

$this->title = $this->context->icon.' '.Module::t('module', 'Create Doc');
$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = ['label' => $this->context->icon.' '.Module::t('module', 'Docs'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;

// Автоматически присваиваем вес
$model->weight =Doc::getMaxWeight()+10;
echo $this->render(
    '_form',
    [
        'model' => $model,
    ]
);