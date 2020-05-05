<?php

use app\modules\jk\models\Stop;
use app\modules\jk\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */
/* @var $order app\modules\jk\models\Order */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Возврат заявки';
$this->params['breadcrumbs'][] = ['label' => 'ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => Module::t('order', 'Orders'), 'url' => ['/jk/orders']];
$this->params['breadcrumbs'][] = ['label' => $order->id, 'url' => ['/jk/order/view', 'id' => $order->id]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-md-12">
        <div class="card  card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="callout callout-info">
                    <h5>Укажите причину отказа от материальной помощи от сообщества</h5>
                    <p>В выпадающем списке выберите причину возврата, а также укажите ваш комментарий, нам это нужно для статистики по отказам.
                        Далее нажмите кнопку Сохранить.
                    </p>
                </div>

                <?php
                $statuses = Stop::find()->where('status_id=' . $order->status_id)->all();
                $items = ArrayHelper::map($statuses, 'id', 'title');
                $params = ['prompt' => 'Выберите...'];
                echo $form->field($model, 'stop_id')->dropDownList($items, $params);
                ?>

                <?= $form->field($model, 'comment')->textarea() ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

