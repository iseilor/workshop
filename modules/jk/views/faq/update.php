<?php

use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */

$this->title = Module::t(
    'module',
    'Update Faq: {name}',
    [
        'name' => $model->id,
    ]
);
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-question"></i> '.Module::t('module', 'Faqs'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render(
    '_form',
    [
        'model' => $model,
    ]
) ?>