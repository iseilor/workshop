<?php

use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */

$this->title = \kartik\icons\Icon::show('plus').Module::t('child', 'Create Child');
$this->params['breadcrumbs'][] = ['label' =>\kartik\icons\Icon::show('baby'). Module::t('child', 'Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('_form', [
    'model' => $model,
]) ?>