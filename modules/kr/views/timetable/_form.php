<?php

use app\modules\kr\models\Block;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Timetable */
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
            <div class="col-3">
                <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'weight')->textInput() ?>
            </div>
            <div class="col-3">
                <?= $form->field($model, 'block_id')->dropDownList(ArrayHelper::merge(['0' => 'Все'],
                    ArrayHelper::map(Block::find()->all(), 'id', 'title'))); ?>
                <?= $form->field($model, 'groups')->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'curator')->textarea(['rows' => 3]) ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'description')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 300,
                            'plugins' => [
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