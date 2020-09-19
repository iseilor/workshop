<?php

use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->widget(
        Widget::class,
        [
            'settings' => [
                'lang' => 'ru',
                'minHeight' => 400,
                'plugins' => [
                    'clips',
                    'fullscreen',
                ],
            ],
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Icon::show('save').Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
