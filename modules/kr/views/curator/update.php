<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Curator */

$this->title = Icon::show('user-graduate').Module::t('curator', 'Update Curator: {name}', [
    'name' => $model->fio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Curators'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="curator-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
