<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Timetable */

$this->title = Icon::show('edit') . Module::t('timetable', 'Update Timetable: {name}', [
        'name' => $model->title,
    ]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('list').Module::t('timetable', 'Timetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>