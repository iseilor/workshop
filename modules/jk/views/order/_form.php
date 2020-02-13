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
                    <h3 class="card-title"><i class="fas fa-ruble-sign"></i> Оформление заявки на участие в Жилищной Кампании</h3>
                </div>

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="card-body">
                    <div class="callout callout-info">
                        <h3><i class="fas fa-info"></i> Инструкция</h3>
                        <ul>
                            <li>Чтобы не потерять уже введенные данные, нажмите кнопку <strong>Сохранить заявку</strong>, и вы всегда потом сможете вернуться к её дозаполнению</li>
                            <li>Если у вас возникли какие-то вопросы, то нажмите кнопку <strong>Написать куратору</strong>, и ответсвенный сотрудник ответит на все интересующие вас вопросы</li>
                            <li>После того, как вы заполните все необходимые поля, нажмите кнопку <strong>Отправить заявку на проверку куратору</strong></li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'is_mortgage')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
                            <?= $form->field($model, 'mortgage_file',['options' => ['class' => 'form-group hide']])->fileInput()->hint('* Прикрепите кредитный договор с актуальным графиком платежей в формате PDF'); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
                            <?= $form->field($model, 'spouse_fio')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'is_spouse_dzo')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
                            <?= $form->field($model, 'child_count')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                </div>
                <div class="card-footer">

                    <?= Html::submitButton(
                        '<i class="fas fa-save"></i> Сохранить заявку',
                        [
                            'class' => 'btn btn-info',
                            'id' => 'btn-save',
                        ]
                    ) ?>

                    <?= Html::submitButton(
                        '<i class="fas fa-comments"></i> Написать куратору',
                        [
                            'class' => 'btn btn-success',
                            'id' => 'btn-save',
                        ]
                    ) ?>
                    <?= Html::submitButton(
                        '<i class="fas fa-check-square"></i> Отправить заявку на проверку куратору',
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

<?php
$script = <<< JS
$(document).ready(function() {
    
    // Показываем прикрепление кредитного договора, если выбрано, что оформлена ипотека
    $('#order-is_mortgage').on('change', function() {
        if (this.value==1){
            $('.field-order-mortgage_file').show();
        }else{
            $('.field-order-mortgage_file').hide();
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);