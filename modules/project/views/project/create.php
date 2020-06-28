<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\Project */

$this->title = Yii::t('app', 'Create Project');
$this->params['breadcrumbs'][] = ['label' => Module::t('project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>