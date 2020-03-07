<?php

use app\modules\jk\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'Create Order');
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <?= $this->render('_form', [
        'model' => $model,
        'userChildDataProvider'=>$userChildDataProvider
    ]) ?>

</div>
