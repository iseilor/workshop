<?php

use app\modules\jk\models\OrderStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\OrderStop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card card-primary">
            <div class="card-body">
                <?php
                $orderStatuses = OrderStatus::find()->all();
                $items = ArrayHelper::map($orderStatuses, 'id', 'title');
                $params = ['prompt' => 'Выберите'];
                echo $form->field($model, 'order_status_id')->dropDownList($items, $params);
                ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
