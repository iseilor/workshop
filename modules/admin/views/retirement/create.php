<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Retirement */

$this->title = Yii::t('app', 'Добавить запись');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retirement-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
