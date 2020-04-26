<?php

use app\modules\user\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = Module::t('spouse', 'Create Spouse');
$this->params['breadcrumbs'][] = ['label' => Module::t('spouse', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
