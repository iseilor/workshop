<?php

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

$this->title = 'Калькулятор суммы компенсации процентов';
$this->params['breadcrumbs'][] = ['label' => 'Жилищная политика', 'url' => ['/zhp/']];
//$this->params['breadcrumbs'][] = ['label' => 'Percents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

use app\modules\jk\assets\JkAsset;
JkAsset::register($this);

 ?>
<div class="row">
    <div class="col-md-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calculator nav-icon"></i> Калькулятор</h3>
            </div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>