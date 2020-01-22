<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Mrf */

$this->title = Yii::t('app', 'Create Mrf');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mrves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mrf-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
