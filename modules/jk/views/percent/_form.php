<?php

use app\modules\jk\models\Percent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

/* @var $form yii\widgets\ActiveForm */

use app\modules\jk\assets\PercentAsset;

PercentAsset::register($this);

// TODO: Разобраться с работой Assets

/*
$bundle = $this->getAssetManager()->getBundle('\app\modules\jk\assets\PercentAsset');
<img src="<?php echo $bundle->baseUrl ?><!--/img/percent_form_family_income.png" />
*/
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
                    <ul>
                        <li>Обращаем Ваше внимание, что калькулятор считает максимально возможный размер материальной помощи, без учета решения жилищной комиссии и утвержденного Бюджета на
                            соответствующий год
                        </li>
                        <li>Максимальный размер компенсации процентов не может быть больше 1 млн.руб. за весь период действия дополнительного соглашения
                        </li>
                        <li>Нормативные <?= Html::a('документы', ['/jk/doc']) ?> по жилищной компании</li>
                        <li>Часто задаваемые <?= Html::a('вопросы', ['/jk/faq']) ?> по жилищной компании</li>
                        <li>Главный <?= Html::a('куратор', ['/jk/doc']) ?> жилищной компании</li>
                    </ul>
                    <div class="col-md-4">
                        <?php $tabindex=1;?>
                        <?= $form->field($model, 'family_count')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('family_count')) ?>
                        <?= $form->field($model, 'family_income')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('family_income')) ?>
                        <?= $form->field($model, 'area_total')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('area_total'))  ?>
                        <?= $form->field($model, 'area_buy')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('area_buy')) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'cost_total')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('cost_total')) ?>
                        <?= $form->field($model, 'cost_user')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('cost_user')) ?>
                        <?= $form->field($model, 'bank_credit')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('bank_credit')) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'loan')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('loan')) ?>
                        <?= $form->field($model, 'percent_count')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('percent_count')) ?>
                        <?= $form->field($model, 'percent_rate')->textInput(['tabindex'=>$tabindex++])->label($model->getAttributeLabels2('percent_rate')) ?>
                    </div>
                    <div class="col-md-4 d-none">
                        <?= $form->field($model, 'compensation_result')->textInput()?>
                        <?= $form->field($model, 'compensation_count')->textInput()?>
                        <?= $form->field($model, 'compensation_years')->textInput()?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <?= Html::button(
                    '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                    [
                        'class' => 'btn btn-info',
                        'id' => 'percent-calc',
                        'data' => ['url' => Url::home() . 'jk/percent/calc']
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

