<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Student */

$this->title = Icon::show('edit').Module::t('student', 'Update Student: {name}', [
    'name' => $model->user->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').Module::t('module','admin'), 'url' => ['/kr/admin/index']];

$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('student', 'Students'), 'url' => ['admin']];



$this->params['breadcrumbs'][] = $this->title;
?>





<?= $this->render('_form', [
    'model' => $model,
]) ?>