<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\JkZaimType */

$this->title = Yii::t('app', 'Create Jk Zaim Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jk Zaim Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jk-zaim-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
