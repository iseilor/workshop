<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Block */

$this->title = Icon::show('edit').Module::t('block', 'Update Block: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('tools').Module::t('module','admin'), 'url' => ['/kr/admin/index']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('cubes').Module::t('block','Blocks'), 'url' => ['/kr/block/admin']];
$this->params['breadcrumbs'][] = $this->title;

?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>