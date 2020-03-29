<?php


use app\modules\pulsar\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */


$this->title = Module::t('module', 'Create Pulsar');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Pulsars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pulsar-create">

   <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
