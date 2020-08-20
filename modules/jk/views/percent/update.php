<?php

use app\modules\jk\assets\PercentAsset;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$this->title = Icon::show('calculator').Module::t('percent', 'Update Percent: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('calculator').Module::t('percent', 'Percents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

PercentAsset::register($this);
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>