<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */

$this->title = Icon::show('question'). Module::t(
    'faq',
    'Update Faq: {name}',
    [
        'name' => $model->id,
    ]
);
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('question').Module::t('faq', 'FAQ'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render(
    '_form',
    [
        'model' => $model,
    ]
) ?>