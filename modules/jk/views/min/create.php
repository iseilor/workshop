<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Min */

$this->title = Yii::t('app', 'Create Min');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="min-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
