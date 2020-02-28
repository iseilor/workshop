<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\OrderStage */

$this->title = Yii::t('app', 'Create Order Stage');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Stages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-stage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
