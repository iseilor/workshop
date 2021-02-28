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
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Внимание!</h5>
        Приём новых заявок для участия в "Жилищной программе-2021" завершён.<br/>
        Работа с уже поданными заявками возможна через личный кабинет сотрудника (слева сверху ссылка "Мой кабинет")
    </div>

     <!--$this->render('form/form', [
        'model' => $model,
        'usermd' => $usermd,
        'spouse' => $spouse,
        'passport' => $passport,
        'mins' => $mins,
        //'userChildDataProvider'=>$userChildDataProvider
    ])-->

</div>
