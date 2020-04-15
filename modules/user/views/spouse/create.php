<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = Yii::t('app', 'Create Spouse');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
