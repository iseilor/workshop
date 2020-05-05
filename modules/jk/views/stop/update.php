<?php

use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */

$this->title = Module::t('stop', 'Update Stop: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('stop', 'Stops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>