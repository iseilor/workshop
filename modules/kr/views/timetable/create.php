<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Timetable */

$this->title = Yii::t('app', 'Create Timetable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>