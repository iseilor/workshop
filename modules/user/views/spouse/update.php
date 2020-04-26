<?php

use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = Module::t('spouse', 'Update Spouse: {name}', [
    'name' => $model->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Module::t('spouse', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>