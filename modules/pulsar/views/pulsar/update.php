<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\pulsar\models\Pulsar */

$this->title = Yii::t('app', 'Update Pulsar: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pulsars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pulsar-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
