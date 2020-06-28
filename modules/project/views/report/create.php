<?php

use app\modules\project\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\Task */

$this->title = Module::t('task', 'Create Task');
$this->params['breadcrumbs'][] = ['label' => Module::t('task', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-task-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
