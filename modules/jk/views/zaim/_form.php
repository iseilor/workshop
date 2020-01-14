<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $form yii\widgets\ActiveForm */

use app\modules\jk\assets\ZaimAsset;
ZaimAsset::register($this);
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
                <?= $form->field($model, 'family_count')->textInput() ?>
                <?= $form->field($model, 'family_income')->textInput() ?>
                <?= $form->field($model, 'area_total')->textInput() ?>
            </div>
            <div class="col-md-4">

                <?= $form->field($model, 'area_buy')->textInput() ?>
                <?= $form->field($model, 'cost_total')->textInput() ?>
                <?= $form->field($model, 'cost_user')->textInput() ?>

            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'bank_credit')->textInput() ?>
                <?= $form->field($model, 'rf_area')->dropDownList(
                    [
                        "0" => "Не выбрано",
                        "1" => "г. Москва",
                        "2" => "Московская область",
                        "20" => "г. Санкт-Петербург",
                        "19" => "Ленинградская область",
                        "3" => "Белгородская область",
                        "4" => "Брянская область",
                        "5" => "Владимирская область",
                        "7" => "Воронежская область",
                        "6" => "Ивановская область",
                        "8" => "Калужская область",
                        "9" => "Костромская область",
                        "10" => "Курская область",
                        "11" => "Липецкая область",
                        "12" => "Орловская область",
                        "13" => "Рязанская область",
                        "14" => "Смоленская область",
                        "15" => "Тамбовская область",
                        "16" => "Тверская область",
                        "17" => "Тульская область",
                        "18" => "Ярославская область"
                    ]
                ); ?>
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