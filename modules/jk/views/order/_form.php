<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="row">
        <div class="col-md-12">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-ruble-sign"></i> Оформление заявки на участие в Жилищной Кампании</h3>
                </div>

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="card-body">
                    <!--<div class="callout callout-info">
                        <h3><i class="fas fa-info"></i> Инструкция</h3>
                        <ul>
                            <li>Чтобы не потерять уже введенные данные, нажмите кнопку <strong>Сохранить заявку</strong>, и вы всегда потом сможете вернуться к её дозаполнению</li>
                            <li>Если у вас возникли какие-то вопросы, то нажмите кнопку <strong>Написать куратору</strong>, и ответсвенный сотрудник ответит на все интересующие вас вопросы</li>
                            <li>После того, как вы заполните все необходимые поля, нажмите кнопку <strong>Отправить заявку на проверку куратору</strong></li>
                        </ul>
                    </div>
                    -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab-family-tab" data-toggle="pill" href="#tab-family" role="tab" aria-controls="tab-family" aria-selected="true">Семья</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-house-tab" data-toggle="pill" href="#tab-house" role="tab" aria-controls="tab-house" aria-selected="false">Жильё</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-money-tab" data-toggle="pill" href="#tab-money" role="tab" aria-controls="tab-money" aria-selected="false">Доходы</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="tab-family" role="tabpanel" aria-labelledby="tab-family-tab">
                                            <?= $this->render('_form_tab_family', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-house" role="tabpanel" aria-labelledby="tab-house-tab">
                                            <?= $this->render('_form_tab_house', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-money" role="tabpanel" aria-labelledby="tab-money-tab">
                                            <?= $this->render('_form_tab_money', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

