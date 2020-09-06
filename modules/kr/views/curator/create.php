<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Curator */

$this->title = Yii::t('app', 'Create Curator');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="curator-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
