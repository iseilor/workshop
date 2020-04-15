<?php

use app\modules\nsi\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\nsi\models\Color */

$this->title = Module::t('color', 'Update Color: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('color', 'Colors'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>