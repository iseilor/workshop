<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Rf */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= Icon::show('sitemap') ?>Параметры РФа или МРФа</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">

                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'description')->textarea(['rows' => 10]) ?>
                    </div>
                    <div class="col-md-4">


                        <?php
                        $data = \app\modules\user\models\User::find()
                            ->select(["concat(fio,' [', email,']') as value", "concat(fio,' [', email,']') as label", 'id as id','email as email','work_address as address','work_phone as phone'])
                            ->asArray()
                            ->all();?>

                        <?= $form->field($model, 'user')->widget(
                                AutoComplete::class, [
                                'clientOptions' => [
                                    'source' => $data,
                                    'minLength' => '3',
                                    'autoFill' => true,
                                    'select' => new JsExpression("function( event, ui ) {
                                        $('#rf-user_id').val(ui.item.id);
                                        $('#rf-email').val(ui.item.email);
                                        $('#rf-phone').val(ui.item.phone);
                                        $('#rf-address').val(ui.item.address);
                                    }")
                                ],
                                'options'=>[
                                    'class'=>'form-control'
                                ]
                            ]);
                         ?>
                        <?= $form->field($model, 'user_id',['options' => ['class' => 'd-none']])->hiddenInput() ?>
                        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'coefficient')->textInput() ?>
                        <?= $form->field($model, 'percent_max')->textInput() ?>
                        <?= $form->field($model, 'loan_max')->textInput() ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>