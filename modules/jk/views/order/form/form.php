<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */
/* @var $form yii\widgets\ActiveForm */
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */
?>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-ruble-sign"></i> Оформление заявки на участие в Жилищной Кампании</h3>
                </div>

                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="card-body">
                    <!--<div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Информация</h5>
                        После того, как вы заполните все необходимые поля и прикрепите документы по всем членам семьи, вы сможете передать заявку на проверку куратору жилищной кампании
                    </div>-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab-params-tab" data-toggle="pill" href="#tab-params" role="tab" aria-controls="tab-params" aria-selected="true">
                                                <?=Icon::show('list')?>Общие параметры</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="tab-family-tab" data-toggle="pill" href="#tab-family" role="tab" aria-controls="tab-family" aria-selected="false"><i
                                                        class="fas fa-users"></i> Семья</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-house-tab" data-toggle="pill" href="#tab-house" role="tab" aria-controls="tab-house" aria-selected="false"><i
                                                        class="fas fa-home"></i> Жилое помещение</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-ipoteka-tab" data-toggle="pill" href="#tab-ipoteka" role="tab" aria-controls="tab-ipoteka" aria-selected="false">
                                                <?=Icon::show('file-invoice-dollar')?>Ипотека</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab-money-tab" data-toggle="pill" href="#tab-money" role="tab" aria-controls="tab-money" aria-selected="false"><i
                                                        class="fas fa-ruble-sign"></i> Финансы</a>
                                        </li>

                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="tab-params" role="tabpanel" aria-labelledby="tab-params-tab">
                                            <?= $this->render('form_tab_params', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-family" role="tabpanel" aria-labelledby="tab-family-tab">
                                            <?= $this->render('form_tab_family',
                                                              [
                                                                  'model' => $model,
                                                                  'form' => $form,
                                                                  //'userChildDataProvider'=>$userChildDataProvider

                                                              ]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-house" role="tabpanel" aria-labelledby="tab-house-tab">
                                            <?= $this->render('form_tab_house', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-ipoteka" role="tabpanel" aria-labelledby="tab-ipoteka-tab">
                                            <?= $this->render('form_tab_ipoteka', ['model' => $model, 'form' => $form]) ?>
                                        </div>
                                        <div class="tab-pane fade" id="tab-money" role="tabpanel" aria-labelledby="tab-money-tab">
                                            <?= $this->render('form_tab_money', ['model' => $model, 'form' => $form]) ?>
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
                            'value' => 1,
                            'name' => 'save'
                        ]
                    ) ?>

                    <!--<?= Html::submitButton(
                        '<i class="fas fa-comments"></i> Написать куратору',
                        [
                            'class' => 'btn btn-success',
                            'id' => 'btn-message',
                        ]
                    ) ?>
                    <?= Html::submitButton(
                        '<i class="fas fa-check-square"></i> Отправить куратору',
                        [
                            'class' => 'btn btn-success',
                            'id' => 'btn-check',
                            'value' => 1,
                            'name' => 'check'
                        ]
                    ) ?>-->


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
    
    // Если есть супруга
    $('#order-is_spouse').on('change', function() {
        if (this.value==1){
            $('.is-spouse').removeClass('hide');
        }else{
            $('.is-spouse').addClass('hide');
        }
    });
    
    // Если есть дети
    $('#order-child_count').on('change', function() {
        if (this.value > 0){
            $('.is-child').removeClass('hide');
        }else{
            $('.is-child').addClass('hide');
        }
    });
    
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);

