<?php

use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>

    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">


        <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->widget(
            Widget::class,
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen',
                    ],
                ],
            ]
        ); ?>

        <div class="card-footer">
            <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
