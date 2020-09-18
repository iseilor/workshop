<?php

use app\modules\st\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\st\models\Guest */

$this->title =Icon::show('edit').Module::t('guest', 'Update Guest: {name}', [
    'name' => $model->guest_fio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Guests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="guest-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
