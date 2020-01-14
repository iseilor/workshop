<?php

/* @var $this yii\web\View */

/* @var $model app\modules\jk\models\Percent */
/* @var $mins app\modules\jk\models\Min */

$this->title = "<i class='fas fa-calculator nav-icon'></i> Калькулятор";
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render(
    '_form',
    [
        'model' => $model
    ]
) ?>