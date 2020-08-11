<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\CorpNorm */

$this->title = Yii::t('app', 'Изменить запись: {name}', [
    'name' => $model->number,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->number, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="corpnorm-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
