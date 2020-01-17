<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-question"></i> Вопрос</h3>
            </div>

            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">


                <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>




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
