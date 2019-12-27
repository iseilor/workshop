<?php
use app\modules\jk\Module;
/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */

$this->title = Module::t('module', 'Create Zaim');
$icon = '<i class="fas fa-calculator nav-icon"></i>';
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Zaims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="result" class="alert alert-success alert-dismissible d-none">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Расчёт окончен</h5>
    <ul>
        <li>Максимальный размер займа, руб: <strong id="result_money">0</strong></li>
        <li>Максимальный срок займа, лет: <strong id="result_year">0</strong></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=$icon;?> <?=$this->title;?></h3>
            </div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>