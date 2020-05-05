<?php

use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */

$this->title = Module::t('stop', 'Create Stop');
$this->params['breadcrumbs'][] = ['label' => 'ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/jk/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('stop', 'Stops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;



?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>