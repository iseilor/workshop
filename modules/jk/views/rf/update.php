<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Rf */

$this->title = Icon::show('edit').Module::t('rf', 'Update Rf: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rves'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rf-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
