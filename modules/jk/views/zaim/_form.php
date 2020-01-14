<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $form yii\widgets\ActiveForm */
/* @var $mins app\modules\jk\models\Min */

use app\modules\jk\assets\ZaimAsset;
ZaimAsset::register($this);
$tabindex = 1;
?>
<?php $form = ActiveForm::begin(['id' => 'zaim-form',]); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted">* Обращаем ваше внимание, что калькулятор считает
                    максимально возможный размер материальной помощи, без учёта решения жилищной
                    комиссии и утверждённого бюджета на соответствующий год<br>
                    * Максимальный размер займа не может быть больше 1 млн. руб.
                </p>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'family_count')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('family_count')) ?>
                <?= $form->field($model, 'family_income')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('family_income')) ?>
                <?= $form->field($model, 'area_total')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('area_total')) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'area_buy')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('area_buy')) ?>
                <?= $form->field($model, 'cost_total')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('cost_total')) ?>
                <?= $form->field($model, 'cost_user')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('cost_user')) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'bank_credit')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('bank_credit')) ?>
                <?= $form->field($model, 'rf_area')->dropDownList(ArrayHelper::map($mins, 'id', 'title'),['prompt'=>'Выберите...'])->label($model->getAttributeLabels2('rf_area')); ?>
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
            ['class' => 'btn btn-info', 'id' => 'zaim-calc']
        ) ?>
        <?= Html::submitButton(
            '<i class="fas fa-save nav-icon"></i> Сохранить',
            ['class' => 'btn btn-success']
        ) ?>
        <?= Html::a(
            Yii::t('app', 'Отмена'),
            ['create'],
            ['class' => 'btn btn-default float-right']
        ) ?>
    </div>
<?php ActiveForm::end(); ?>