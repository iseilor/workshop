<?php

use app\modules\project\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\Project */

$this->title = Module::t('project', 'Update Project: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
