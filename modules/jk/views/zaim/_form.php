<?php


use app\modules\jk\assets\ZaimAsset;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $form yii\widgets\ActiveForm */

/* @var $mins app\modules\jk\models\Min */

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
                        <div class="col-md-4">
                            <?= $form->field($model, 'family_count')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_count']]) ?>
                            <?= $form->field($model, 'family_income')->widget(
                                MaskedInput::class,
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_income']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'area_total')->widget(
                                MaskedInput::class,
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_total']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            )
                            ?>
                            <?= $form->field($model, 'area_buy')->widget(
                                MaskedInput::class,
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_buy']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            )
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'cost_total')->widget(
                                MaskedInput::class,
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['cost_total']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            )
                            ?>
                            <?= $form->field($model, 'min_id')->dropDownList(ArrayHelper::map($mins, 'id', 'title'), ['prompt' => 'Выберите...'])->label($model->attributeDescription()['min_id']); ?>
                        </div>
                        <?php if ($model->id): ?>
                            <div class="col-md-12">
                                <?= $this->render('_result', ['model' => $model]); ?>
                                <?= Html::a(
                                    Yii::$app->params['module']['jk']['order']['icon'] . ' Оформить заявку на МП',
                                    Url::to(['/jk/order/create','zaim_id'=>$model->id],true),
                                    [
                                        'class' => 'btn btn-success',
                                        'id' => 'btn-save',
                                        'title' => 'Приступить к оформлению материальной помощи по жилищной программе',
                                    ]
                                ) ?>
                                <?= Html::submitButton(
                                    Yii::$app->params['btn']['email']['icon'] . ' Отправить расчёт на email',
                                    [
                                        'class' => 'btn btn-warning',
                                        'id' => 'btn-save',
                                        'title' => 'Отправить предварительные рассчёты вам на email',
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
<?= $this->render('modal-instruction') ?>