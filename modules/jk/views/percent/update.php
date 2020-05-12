<?php

use app\modules\jk\assets\PercentAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$this->title = Yii::t('app', 'Update Percent: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Percents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

PercentAsset::register($this);
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>