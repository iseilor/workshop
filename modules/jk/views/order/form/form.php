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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
                                <div class="card-header p-0 border-bottom-0">
                                    <?php
                                    $tabs = [
                                        ['name' => Icon::show('list') . 'Параметры', 'id' => 'params', 'tab-class' => 'active', 'selected' => 'true', 'tabs-class' => 'show active'],
                                        ['name' => Icon::show('users') . 'Семья', 'id' => 'family', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                        ['name' => Icon::show('female') . 'Супргу(а)', 'id' => 'spouse', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                        ['name' => Icon::show('baby') . 'Дети', 'id' => 'child', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                        ['name' => Icon::show('home') . 'ЖП', 'id' => 'house', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                        ['name' => Icon::show('file-invoice-dollar') . 'Ипотека', 'id' => 'ipoteka', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                        ['name' => Icon::show('ruble-sign') . 'Финансы', 'id' => 'money', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                    ];
                                    echo Html::ul($tabs, [
                                        'item' => function ($item, $index) {
                                            return Html::tag(
                                                'li',
                                                Html::a($item['name'], '#tabs-' . $item['id'], [
                                                    'class' => 'nav-link ' . $item['tab-class'],
                                                    'id' => 'tab-' . $item['id'],
                                                    'data-toggle' => 'pill',
                                                    'role' => 'tab',
                                                    'aria-controls' => 'tabs-' . $item['id'],
                                                    'aria-selected' => $item['selected'],
                                                ]),
                                                ['class' => 'nav-item']
                                            );
                                        },
                                        'class' => 'nav nav-tabs',
                                        'id' => 'custom-tabs-three-tab',
                                        'role' => 'tablist',
                                    ]) ?>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <?php foreach ($tabs as $tab): ?>
                                            <div class="tab-pane fade <?= $tab['tabs-class'] ?>" id="tabs-<?= $tab['id'] ?>" role="tabpanel" aria-labelledby="tab-<?= $tab['id'] ?>">
                                                <?= $this->render('form_' . $tab['id'], ['model' => $model, 'form' => $form]) ?>
                                            </div>
                                        <?php endforeach; ?>
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
                            'name' => 'save',
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
                            'name' => 'check',
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

