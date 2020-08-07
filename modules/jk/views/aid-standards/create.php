<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\AidStandards */

$this->title = Yii::t('app', 'Добавить запись');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aidstandards-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
