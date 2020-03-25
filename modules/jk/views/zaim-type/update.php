<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\JkZaimType */

$this->title = Yii::t('app', 'Update Jk Zaim Type: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jk Zaim Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="jk-zaim-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
