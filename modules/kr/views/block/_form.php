<?php

use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Block */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">

        <div class="row">
            <div class="col-4">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->hint('<p>Иконки на сайте: ' . HTMl::a('fontawesome.com',
                        'https://fontawesome.com', ['target' => '_blank']) . ' <strong>Пример</strong>: user</p>') ?>
                <?= $form->field($model, 'color')->dropDownList([
                    'success' => 'Зелёный',
                    'danger' => 'Красный',
                    'warning' => 'Жёлтый',
                    'primary' => 'Синий',
                    'purple' => 'Пурпурный',
                ]); ?>
                <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-8">
                <?= $form->field($model, 'description')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 250,
                            'plugins' => [
                                'clips',
                                'fullscreen',
                            ],
                        ],
                    ]
                ); ?>
            </div>
        </div>
    </div>
    <div class="card-footer">

        <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>