<?php
use app\modules\jk\Module;
/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $model app\modules\jk\models\Min */

$icon = '<i class="fas fa-calculator nav-icon"></i> ';
$this->title = $icon.Module::t('module', 'Create Zaim');
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Zaims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_form', [
    'model' => $model,
    'mins' => $mins
]) ?>