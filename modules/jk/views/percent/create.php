<?php

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$icon = '<i class="fas fa-calculator nav-icon"></i>';
$this->title = "Калькулятор суммы компенсации процентов";
$this->params['breadcrumbs'][] = ['label' => 'Жилищная политика', 'url' => ['/jk/']];
//$this->params['breadcrumbs'][] = ['label' => 'Percents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\modules\jk\assets\JkAsset;
JkAsset::register($this);
?>

<div id="result" class="alert alert-success alert-dismissible d-none">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Расчёт окончен</h5>
    <ul>
        <li>Максимальный размер компенсации процентов в год, руб: <strong id="result_money">0</strong></li>
        <li>Максимальный срок компенсации процентов, лет: <strong id="result_year">0</strong></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calculator nav-icon"></i> Калькулятор</h3>
            </div>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>