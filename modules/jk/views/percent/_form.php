<?php

use app\modules\jk\assets\PercentAsset;
use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */

/* @var $form yii\widgets\ActiveForm */

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
                    <h3 class="card-title"><?= Icon::show('calculator') . Module::t('percent', 'Calculator Percent') ?></h3>
                </div>
                <?php $form = ActiveForm::begin(
                    [
                        'id' => 'percent-form',
                        'enableAjaxValidation' => true,
                        'validateOnBlur' => true,
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
                                бюджета н
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
                            <?= ""// $form->field($model, 'family_income')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription($img)['family_income']])      ?>

                            <?=
                            $form->field($model, 'family_income')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_income']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>



                            <?= $form->field($model, 'area_total')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_total']]) ?>
                            <?= $form->field($model, 'area_buy')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_buy']]) ?>
                        </div>
                        <div class="col-md-4">

                            <!--Полная стоимость жилья-->
                            <?=
                            $form->field($model, 'cost_total')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => [
                                        'data-toggle' => "tooltip",
                                        'title' => $model->attributeDescription()['cost_total'],
                                        'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_user');
                                                $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-bank_credit');
                                                $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-loan');",
                                    ],

                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>

                            <!--Собственные средства работника-->
                            <?=
                            $form->field($model, 'cost_user')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => [
                                        'data-toggle' => "tooltip",
                                        'title' => $model->attributeDescription()['cost_user'],
                                        'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');
                                                $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-bank_credit');
                                                $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-loan');",
                                    ],

                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>
                            <!--Размер кредита в банке-->
                            <?=
                            $form->field($model, 'bank_credit')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => [
                                        'data-toggle' => "tooltip",
                                        'title' => $model->attributeDescription()['bank_credit'],
                                        'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');
                                    $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_user');
                                    $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-loan');",
                                    ],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>


                        </div>
                        <div class="col-md-4">
                            <!--Займ-->
                            <?=
                            $form->field($model, 'loan')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => [
                                        'data-toggle' => "tooltip",
                                        'title' => $model->attributeDescription()['loan'],
                                        'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_total');
                                    $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-cost_user');
                                    $(this).closest('form').yiiActiveForm('validateAttribute', 'percent-bank_credit');",
                                        'placeholder' => 0,
                                    ],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>

                            <!--Сумма процентов -->
                            <?=
                            $form->field($model, 'percent_count')->widget(
                                \yii\widgets\MaskedInput::class,
                                [
                                    'options' => [
                                        'data-toggle' => "tooltip",
                                        'title' => $model->attributeDescription()['percent_count'],
                                    ],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney'],
                                ]
                            )
                            ?>

                            <?= $form->field($model, 'percent_rate')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['percent_rate']]) ?>
                        </div>

                        <?php if ($model->id): ?>
                            <div class="col-md-12">
                                <div class="callout callout-success bg-success color-palette">
                                    <h3><?= Icon::show('calculator') ?>Результат расчёта</h3>
                                    <ul>
                                        <li>Максимальный размер компенсации процентов в год, руб: <strong><?= Yii::$app->formatter->asInteger($model->compensation_count); ?></strong></li>
                                        <li>Максимальный срок компенсации процентов: <strong><?= $model->compensation_years ?></strong> лет</li>
                                        <li>Ставка компенсации процентов: <strong><?= $model->SKP ?></strong> %</li>
                                    </ul>
                                    <hr/>
                                    <small>
                                        * Полученная сумма и срок возврата материальной помощи являются предварительными,
                                        и могут быть скорректированы по решению жилищной комиссии<br/>
                                        * Результаты расчёта вам также будут доступны в личном кабинете
                                    </small>
                                </div>
                                <?= Html::a(
                                    Yii::$app->params['module']['jk']['order']['icon'] . ' Оформить заявку на МП',
                                    Url::to(['/jk/order/create', 'percent_id' => $model->id], true),
                                    [
                                        'class' => 'btn btn-success',
                                        'id' => 'btn-save',
                                        'title' => 'Приступить к оформлению материальной помощи по жилищной программе',
                                        'hidden' => 'true',
                                    ]
                                ) ?>
                                <?= Html::submitButton(
                                    Yii::$app->params['btn']['email']['icon'] . ' Отправить расчёт на email',
                                    [
                                        'class' => 'btn btn-warning',
                                        'id' => 'btn-save',
                                        'title' => 'Отправить предварительные рассчёты вам на email',
                                        'hidden' => 'true',
                                    ]
                                ) ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="card-footer">

                    <?= Html::button(
                        Icon::show('file-alt') . 'Инструкция',
                        [
                            'class' => 'btn btn-primary',
                            'id' => 'btn-instruction',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-instruction',
                            'hidden' => 'true',
                        ]
                    ) ?>

                    <?= Html::button(
                        Icon::show('life-ring') . 'Помощник',
                        [
                            'class' => 'btn btn-primary',
                            'id' => 'btn-helper',
                            'onclick' => "startIntro();",
                            'hidden' => 'true',
                        ]
                    ) ?>

                    <?= Html::a(
                        Icon::show('user') . 'Куратор', Url::to(['/jk/curator'], true),
                        [
                            'class' => 'btn btn-primary',
                            'id' => 'btn-save',
                            'title' => 'Связаться с куратором Жилищной Кампании',
                            'hidden' => 'true',
                        ]
                    ) ?>

                    <div class="float-right">
                        <?= Html::a(
                            Yii::t('app', Icon::show('trash') . 'Очистить'),
                            ['create'],
                            ['class' => 'btn btn-danger']
                        ) ?>
                        <?= Html::submitButton(
                            Icon::show('calculator') . 'Рассчитать',
                            [
                                'class' => 'btn btn-success',
                                'id' => 'btn-save',
                                'title' => 'Рассчитать максимально возможный размер материальной помощи, без учета решения жилищной комиссии и утвержденного бюджета на соответствующий год',
                            ]
                        ) ?>
                    </div>
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