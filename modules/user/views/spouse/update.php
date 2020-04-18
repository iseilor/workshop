<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = Yii::t('app', 'Update Spouse: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>