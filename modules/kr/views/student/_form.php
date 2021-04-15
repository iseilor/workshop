<?php

use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
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
        <div class="row">
            <div class="col-6"><?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?></div>
            <div class="col-6"><?= $form->field($model, 'block_id')->dropDownList(ArrayHelper::map(\app\modules\kr\models\Block::find()->all(), 'id', 'title')); ?></div>
            <div class="col-12">
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
            </div>
        </div>

        <div class="card-footer">
            <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
