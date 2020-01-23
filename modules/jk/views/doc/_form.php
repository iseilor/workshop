<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Doc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?=$this->title?></h3>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'file')->fileInput() ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(
                    '<i class="fas fa-save nav-icon"></i> Сохранить',
                    [
                        'class' => 'btn btn-success',
                        'id' => 'btn-save',
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