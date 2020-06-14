<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bot\models\Bot */

$this->title = Yii::t('app', 'Create Bot');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bot-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
