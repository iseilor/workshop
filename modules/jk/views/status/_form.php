<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Status */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'title_short')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-4">
                        <?= $form->field($model, 'progress')->input('number',['min' => 0, 'max' => 100, 'step' => 1]) ?>
                        <?= $form->field($model, 'color')->dropDownList([
                            'success' => 'Зелёный',
                            'danger' => 'Красный',
                            'warning' => 'Жёлтый',
                            'info' => 'Синий',
                        ]); ?>
                        <?= $form->field($model, 'icon')->textInput(['maxlength' => true])->hint('<p>Иконки на сайте: ' . HTMl::a('fontawesome.com',
                                'https://fontawesome.com',['target'=>'_blank']) . ' <strong>Пример</strong>: user</p>') ?>

                    </div>
                    <div class="col-4">
                        <?= $form->field($model, 'is_edit')->dropDownList([
                            '1' => 'Да',
                            '0' => 'Нет',
                        ]); ?>
                        <?= $form->field($model, 'is_cancel')->dropDownList([
                            '1' => 'Да',
                            '0' => 'Нет',
                        ]); ?>
                        <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-12">
                        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>