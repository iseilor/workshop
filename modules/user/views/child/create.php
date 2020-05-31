<?php

use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */

$this->title = Icon::show('plus') . Module::t('child', 'Create Child');
$this->params['breadcrumbs'][] = ['label' => Icon::show('baby') . Module::t('child', 'Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<?= $this->render('_form', [
    'model' => $model,
    'user' => $user,
]) ?>