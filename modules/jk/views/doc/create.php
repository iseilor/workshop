<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Doc */

$this->title = Yii::t('app/jk', 'Create Doc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/jk', 'Docs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
