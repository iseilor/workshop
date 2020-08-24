<?php

use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */

$this->title = Module::t('child', 'Update Child: {name}', [
    'name' => $model->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('baby') . Module::t('child', 'Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fio, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<?= $this->render('_form', [
    'model' => $model,
    'user' => $user,
    'spouse' => $spouse,
]) ?>