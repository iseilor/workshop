<?php

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$icon = '<i class="fas fa-calculator nav-icon"></i>';
$this->title = "Калькулятор суммы компенсации процентов";
$this->params['breadcrumbs'][] = ['label' => 'Жилищная политика', 'url' => ['/jk/']];
//$this->params['breadcrumbs'][] = ['label' => 'Percents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>