<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\AidStandards */

$this->title = Yii::t('app', 'Редактировать запись: {income_bottom}-{income_top}', [
    'income_bottom' => $model->income_bottom,
    'income_top' => $model->income_top,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="aidstandards-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
