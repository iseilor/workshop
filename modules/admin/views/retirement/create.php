<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Retirement */

$this->title = Yii::t('app', 'Create Retirement ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Retirements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrf-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
