<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Status */

$this->title = Yii::t('app', 'Update Order Status: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>