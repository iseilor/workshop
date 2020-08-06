<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\CorpNorm */

$this->title = Yii::t('app', 'Create CorpNorm');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Retirements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="corpnorm-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
