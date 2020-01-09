<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

/* @var $form yii\widgets\ActiveForm */

use app\modules\jk\assets\PercentAsset;

PercentAsset::register($this);
?>
<div id="result">
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calculator nav-icon"></i> Калькулятор</h3>
            </div>

            <?php $form = ActiveForm::begin(['id' => 'percent-form',]); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'family_count')->textInput() ?>
                        <?= $form->field($model, 'family_income')->textInput() ?>
                        <?= $form->field($model, 'area_total')->textInput() ?>
                        <?= $form->field($model, 'area_buy')->textInput() ?>
                    </div>
                    <div class="col-md-4">

                        <?= $form->field($model, 'cost_total')->textInput() ?>
                        <?= $form->field($model, 'cost_user')->textInput() ?>
                        <?= $form->field($model, 'bank_credit')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'loan')->textInput() ?>
                        <?= $form->field($model, 'percent_count')->textInput() ?>
                        <?= $form->field($model, 'percent_rate')->textInput() ?>
                    </div>
                    <div class="col-md-4 d-none">
                        <?= $form->field($model, 'compensation_result')->textInput() ?>
                        <?= $form->field($model, 'compensation_count')->textInput() ?>
                        <?= $form->field($model, 'compensation_years')->textInput() ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::button(
                    '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                    [   'class' => 'btn btn-info',
                        'id' => 'percent-calc',
                        'data'=>['url'=>Url::home().'jk/percent/calc']
                    ]
                ) ?>
                <?= Html::submitButton(
                    '<i class="fas fa-save nav-icon"></i> Сохранить',
                    [
                        'class' => 'btn btn-success',
                        'id' => 'btn-save',
                    ]
                ) ?>
                <?= Html::a(
                    Yii::t('app', 'Отмена'),
                    ['create'],
                    ['class' => 'btn btn-default float-right']
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

