<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Curator */

$this->title = Icon::show('plus').Module::t('curator', 'Create Curator');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').Module::t('module','admin'), 'url' => ['/kr/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('user-graduate').Module::t('curator', 'Curators'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('_form', [
    'model' => $model,
]);