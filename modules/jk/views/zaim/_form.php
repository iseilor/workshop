<?php


use app\modules\jk\Module;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $form yii\widgets\ActiveForm */

/* @var $mins app\modules\jk\models\Min */

use app\modules\jk\assets\ZaimAsset;

ZaimAsset::register($this);

// TODO: Разобраться с работой Assets
$bundle = $this->getAssetManager()->getBundle('\app\modules\jk\assets\PercentAsset');
$img = $bundle->baseUrl . '/img/percent_form_family_income_black.png';
?>

<div id="result"></div>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calculator nav-icon"></i> Калькулятор займа</h3>
            </div>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'zaim-form',
                    'enableAjaxValidation' => true,
                    'validateOnBlur' => true,
                ]
            ); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <h5>Инструкция по работе с калькулятором займа</h5>
                            <ul>
                                <li>Начните заполнять форму и вы увидите <strong>подсказки</strong> и примеры заполнения по каждому полю</li>
                                <li>Обращаем Ваше внимание, что калькулятор считает <strong>максимально возможный размер материальной помощи</strong>, без учета решения жилищной комиссии и
                                    утвержденного
                                    бюджета на
                                    соответствующий год
                                </li>
                                <li>Максимальный размер займа не может быть больше <strong>1 млн.руб.</strong> за весь период действия дополнительного соглашения
                                </li>
                                <li>Вы можете ознакомиться с <?= Html::a('нормативными документами', ['/jk/doc']) ?> по жилищной кампании</li>
                                <li>Вы можете поискать ответ на ваш вопрос среди <?= Html::a('часто задаваемых вопросов', ['/jk/faq']) ?> по жилищной кампании</li>
                                <li>Если вы не нашли нужную вам информацию, то вы всегда можете связаться с <?= Html::a('куратором', ['/jk/doc']) ?> по жилищной кампании и получить ответы на все
                                    интересующие вас вопросы
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'family_count')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_count']]) ?>
                        <?= $form->field($model, 'family_income')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription($img)['family_income']]) ?>
                        <?= $form->field($model, 'area_total')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_total']]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'area_buy')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_buy']]) ?>
                        <?= $form->field($model, 'cost_total')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['cost_total']]) ?>
                        <?= $form->field($model, 'cost_user')->textInput([
                            'data-toggle' => "tooltip",
                            'title' => $model->attributeDescription()['cost_user'],
                            'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'zaim-cost_total');",
                        ]) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'bank_credit')->textInput([
                            'data-toggle' => "tooltip",
                            'title' => $model->attributeDescription()['bank_credit'],
                            'onblur' => "$(this).closest('form').yiiActiveForm('validateAttribute', 'zaim-cost_total');",
                        ]) ?>
                        <?= $form->field($model, 'min_id')->dropDownList(ArrayHelper::map($mins, 'id', 'title'), ['prompt' => 'Выберите...'])->label($model->attributeDescription()['min_id']); ?>
                    </div>

                    <?php if ($model->id): ?>
                        <div class="col-md-12">
                            <div class="callout callout-success bg-success color-palette">
                                <h3>Результат расчёта</h3>
                                <ul>
                                    <li>Максимальный размер займа, руб: <strong><?= Yii::$app->formatter->asInteger($model->compensation_count); ?></strong></li>
                                    <li>Максимальный срок займа, лет: <strong><?= $model->compensation_years ?></strong></li>
                                </ul>
                                <small>* Полученная сумма и срок возврата материальной помощи являются предварительными, и могут быть скорректированы по решению жилищной комиссии</small>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-footer">
                <!--<?= Html::button(
                    '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                    [
                        'class' => 'btn btn-info',
                        'id' => 'zaim-calc',
                        'data' => ['url' => Url::home() . 'jk/zaim/calc'],
                    ]
                ) ?>-->
                <?= Html::submitButton(
                    '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                    ['class' => 'btn btn-success']
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
