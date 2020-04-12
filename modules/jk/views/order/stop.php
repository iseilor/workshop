<?php

use app\modules\jk\models\OrderStop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */
/* @var $order app\modules\jk\models\Order */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="stop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $orderStatuses = OrderStop::find()->where('order_status_id='.$order->status_id)->all();

    $items = ArrayHelper::map($orderStatuses, 'id', 'title');
    $params = ['prompt' => 'Выберите...'];
    echo $form->field($model, 'order_stop_id')->dropDownList($items, $params);
    ?>

    <?= $form->field($model, 'comment')->textarea() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
