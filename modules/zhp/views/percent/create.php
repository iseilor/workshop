<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\zhp\models\Percent */

$this->title = 'Create Percent';
$this->params['breadcrumbs'][] = ['label' => 'Percents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="percent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
