<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Retirement */

$this->title = Yii::t('app', 'Редактировать запись: {name}', [
    'name' => $model->gender,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gender, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="retirement-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
