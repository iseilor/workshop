<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */

$this->title = Yii::t('app', 'Create Stop');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
