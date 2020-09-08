<?php

use app\modules\jk\models\Status;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Status */

$this->title = Yii::t('app', 'Create Order Status');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$model->weight = Status::getMaxWeight() + 10;
echo $this->render('_form', [
    'model' => $model,
]);