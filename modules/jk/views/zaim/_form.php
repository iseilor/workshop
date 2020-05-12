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
                                MaskedInput::className(),
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['family_income']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            ) ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'area_total')->widget(
                                MaskedInput::className(),
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_total']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            )
                            ?>
                            <?= $form->field($model, 'area_buy')->widget(
                                MaskedInput::className(),
                                [
                                    'options' => ['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['area_buy']],
                                    'clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']
                                ]
                            )
                            ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'cost_total')->widget(
                                MaskedInput::className(),
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
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?= Html::submitButton(
                        '<i class="fas fa-calculator nav-icon"></i> Рассчитать',
                        ['class' => 'btn btn-success']
                    ) ?>
                    <?= Html::button(
                        Icon::show('info') . ' Инструкция',
                        [
                            'class' => 'btn btn-info',
                            'id' => 'btn-instruction',
                            'data-toggle' => 'modal',
                            'data-target' => '#modal-instruction'
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
<?= $this->render('modal-instruction') ?>