<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Timetable */

$this->title = Icon::show('plus').Module::t('timetable', 'Create Timetable');
$this->params['breadcrumbs'][] = ['label' => Icon::show('list').Module::t('timetable', 'Timetables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_form', [
    'model' => $model,
]) ?>