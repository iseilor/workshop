<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Doc */

$this->title = Icon::show('file-word') . Module::t(
        'doc',
        'Update Doc: {name}',
        [
            'name' => $model->id,
        ]
    );

$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = ['label' => $this->context->icon . ' ' . Module::t('module', 'Docs'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render(
    '_form',
    [
        'model' => $model,
    ]
) ?>