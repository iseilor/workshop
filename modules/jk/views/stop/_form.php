<?php

use app\modules\jk\models\Status;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin(); ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?php
                $items = ArrayHelper::map(Status::find()->all(), 'id', 'title');
                $params = ['prompt' => 'Выберите'];
                echo $form->field($model, 'status_id')->dropDownList($items, $params);
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
