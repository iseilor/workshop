<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Retirement */

$this->title = Yii::t('app', 'Update Retirement: {name}', [
    'name' => $model->gender,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Retirements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gender, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="retirement-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
