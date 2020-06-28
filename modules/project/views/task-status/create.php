<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\TaskStatus */

$this->title = Yii::t('app', 'Create Task Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Task Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
