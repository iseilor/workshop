<?php

use app\modules\jk\models\Percent;
use app\modules\jk\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

/* @var $form yii\widgets\ActiveForm */

use app\modules\jk\assets\PercentAsset;

PercentAsset::register($this);

// TODO: Разобраться с работой Assets
$bundle = $this->getAssetManager()->getBundle('\app\modules\jk\assets\PercentAsset');
$img = $bundle->baseUrl . '/img/percent_form_family_income_black.png';

?>

<div id="result">
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calculator nav-icon"></i> Калькулятор суммы компенсации процентов</h3>
            </div>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'percent-form',
                    'enableAjaxValidation' => true,
                    'validateOnBlur' => true
                ]
            ); ?>
            <div class="card-body">
                <div class="row">
                    <!--<div class="callout callout-info">
                        <h5>Инструкция по работе с калькулятором суммы компенсации процентов</h5>
                        <ul>
                            <li>Начните заполнять форму и вы увидите <strong>подсказки</strong> и примеры заполнения по каждому полю</li>
                            <li>Обращаем Ваше внимание, что калькулятор считает <strong>максимально возможный размер материальной помощи</strong>, без учета решения жилищной комиссии и
                                утвержденного
                                бюджета на
                                соответствующий год
                            </li>
                            <li>Максимальный размер компенсации процентов не может быть больше <strong>1 млн.руб.</strong> за весь период действия дополнительного соглашения
                            </li>
                            <li>Вы можете ознакомиться с <?= Html::a('нормативными документами', ['/jk/doc'], ['class' => 'a-color-blue']) ?> по жилищной кампании</li>
                            <li>Вы можете поискать ответ на ваш вопрос среди <?= Html::a('часто задаваемых вопросов', ['/jk/faq'], ['class' => 'a-color-blue']) ?> по жилищной кампании</li>
                            <li>Если вы не нашли нужную вам информацию, то вы всегда можете связаться с <?= Html::a('куратором', ['/jk/doc'], ['class' => 'a-color-blue']) ?> по жилищной кампании и
                                получить ответы на все
                                интересующие вас вопросы
                            </li>
                        </ul>
                    </div>-->
                    <div class="col-md-4">
                        <?= $form->field($model, 'family_count')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_count']]) ?>
                        <?= $form->field($model, 'family_income')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription($img)['family_income']]) ?>
                        <?= $form->field($model, 'area_total')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_total']]) ?>
                        <?= $form->field($model, 'area_buy')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_buy']]) ?>
                    </div>
                    <div class="col-md-4">

                        <?= $form->field($model, 'cost_total')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['cost_total']]) ?>
                        <?= $form->field($model, 'cost_user')->textInput(
                            [
                                'data-toggle' => "tooltip",
                                'title' => $model->attributeDescription()['cost_user'],
                                'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');"
                            ]
                        ) ?>
                        <?= $form->field($model, 'bank_credit')->textInput(
                            [
                                'data-toggle' => "tooltip",
                                'title' => $model->attributeDescription()['bank_credit'],
                                'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');"
                            ]
                        ) ?>

                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'loan')->textInput(
                            [
                                'data-toggle' => "tooltip",
                                'title' => $model->attributeDescription()['loan'],
                                'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');"
                            ]
                        ) ?>
                        <?= $form->field($model, 'percent_count')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['percent_count']]) ?>
                        <?= $form->field($model, 'percent_rate')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['percent_rate']]) ?>
                    </div>

                    <?php if ($model->id): ?>
                        <div class="col-md-12">
                            <div class="callout callout-success bg-success color-palette">
                                <h3>Результат расчёта</h3>
                                <ul>
                                    <li>Максимальный размер компенсации процентов, руб: <strong><?= Yii::$app->formatter->asInteger($model->compensation_count); ?></strong></li>
                                    <li>Максимальный срок компенсации процентов, лет: <strong><?= $model->compensation_years ?></strong></li>
                                </ul>
                                <small>* Полученная сумма и срок возврата материальной помощи являются предварительными, и могут быть скорректированы по решению жилищной комиссии</small>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(
                    '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                    [
                        'class' => 'btn btn-success',
                        'id' => 'btn-save',
                        'title'=>'Рассчитать максимально возможный размер материальной помощи, без учета решения жилищной комиссии и утвержденного бюджета на соответствующий год'
                    ]
                ) ?>
                <?= Html::submitButton(
                    Yii::$app->params['btn']['email']['icon'] . ' Отправить расчёт на email',
                    [
                        'class' => 'btn btn-info',
                        'id' => 'btn-save',
                        'title'=>'Отправить предварительные рассчёты вам на email'
                    ]
                ) ?>
                <?= Html::submitButton(
                    Yii::$app->params['btn']['user']['icon'].' Написать куратору',
                    [
                        'class' => 'btn btn-info',
                        'id' => 'btn-save',
                        'title'=>'Связаться с куратором Жилищной Кампании'
                    ]
                ) ?>
                <?= Html::submitButton(
                    Yii::$app->params['module']['jk']['order']['icon'].' Оформить заявку',
                    [
                        'class' => 'btn btn-primary',
                        'id' => 'btn-save',
                        'title'=>'Приступить к оформлению материальной помощи по жилищной программе'
                    ]
                ) ?>
                <?= Html::a(
                    Yii::t('app', '<i class="fas fa-ban"></i> Отмена'),
                    ['create'],
                    ['class' => 'btn btn-default float-right']
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
$script = <<< JS
/*$('#percent-percent_rate').inputmask("decimal", {
    min: 1, 
    max: 100, 
    allowMinus: false, 
    allowPlus: false,
    digits: 2,
    rightAlign: false,
    groupSeparator: " ",
    radixPoint: [",","."],
    autoGroup: true,
    });*/
//$("#percent-percent_rate").inputmask('decimal', {regex: "^[0-9]{1,2}(\\.\\d{1,2})?$"});
//$('#percent-percent_rate').inputmask({ mask: "(9)|(9,9{1,2})|(9.9{1,2})"})
JS;
$this->registerJs($script, yii\web\View::POS_READY);

