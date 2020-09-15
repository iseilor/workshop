<?php

use app\modules\jk\assets\JkOrderAsset;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $form yii\widgets\ActiveForm */
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */

JkOrderAsset::register($this);

// Классы по ипотеки и по займу
$field_percent = 'd-none';
$field_zaim = 'd-none';
if (isset($model->is_mortgage)) {
    if ($model->is_mortgage) {
        $field_percent = '';
    } else {
        $field_zaim = '';
    }
}

$model->filling_step++;

?>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header" data-intro="This is a tooltip!">
                    <h3 class="card-title"><i class="fas fa-ruble-sign"></i> Оформление заявки на участие в Жилищной программе</h3>
                </div>
                <?php $form = ActiveForm::begin(
                        ['options' =>
                            ['enctype' => 'multipart/form-data',
                                'id' => 'jk-order',
                                'class'=>'form-tabs',
                                'data-pjax' => false
                                ]]); ?>
                <?= $form->field($model, 'percent_id', ['options' => ['class' => 'd-none']])->hiddenInput(); ?>
                <?= $form->field($model, 'zaim_id', ['options' => ['class' => 'd-none']])->hiddenInput(); ?>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
                                <div class="card-header p-0 border-bottom-0">
                                    <?php
                                    $tabs = [
                                        ['name' => Icon::show('user') . 'Работник', 'id' => 'user', 'tab-class' => 'active', 'selected' => true, 'tabs-class' => 'show active'],
//                                        ['name' => Icon::show('female') . 'Супруг(а)', 'id' => 'spouse', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
//                                        ['name' => Icon::show('baby') . 'Дети', 'id' => 'child', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
//                                        ['name' => Icon::show('users') . 'Семья', 'id' => 'family', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
//                                        ['name' => Icon::show('file-invoice-dollar') . 'Ипотека', 'id' => 'ipoteka', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
//                                        ['name' => Icon::show('home') . 'ЖП', 'id' => 'house', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
//                                        ['name' => Icon::show('ruble-sign') . 'Финансы', 'id' => 'money', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''],
                                    ];


                                    if ($model->filling_step >= 2) {
                                        $tabs[] = ['name' => Icon::show('female') . 'Супруг(а)', 'id' => 'spouse', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }
                                    if ($model->filling_step >= 3) {
                                        $tabs[] = ['name' => Icon::show('baby') . 'Дети', 'id' => 'child', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }

                                    /*if ($model->filling_step >= 4) {
                                        $tabs[] = ['name' => Icon::show('users') . 'Семья', 'id' => 'family', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }*/
                                    if ($model->filling_step >= 4) {
                                        $tabs[] = ['name' => Icon::show('home') . 'Жильё', 'id' => 'house', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }
                                    if ($model->filling_step >= 5) {
                                        $tabs[] = ['name' => Icon::show('file-invoice-dollar') . 'Ипотека', 'id' => 'ipoteka', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }
                                    if ($model->filling_step >= 6) {
                                        $tabs[] = ['name' => Icon::show('ruble-sign') . 'Финансы', 'id' => 'money', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }
                                    if ($model->filling_step >= 7) {
                                        $tabs[] = ['name' => Icon::show('file-alt') . 'Согласия на обработку ПД', 'id' => 'agreement', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
                                    }


                                    //                                    if ($model->id) {
//                                        $tabs[] = ['name' => Icon::show('file-alt') . 'Согласия на обработку ПД', 'id' => 'agreement', 'tab-class' => '', 'selected' => 'false', 'tabs-class' => ''];
//                                    }
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
                                                <?= $this->render('form_' . $tab['id'], [
                                                    'model' => $model,
                                                    'usermd' => $usermd,
                                                    'spose' => $spose,
                                                    'passport' => $passport,
                                                    'form' => $form,
                                                    'field_percent' => $field_percent,
                                                    'field_zaim' => $field_zaim,
                                                    'mins' => $mins,
                                                ]) ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
<!--                    --><?= "" // Html::button(
//                        Icon::show('info') . 'Запустить помощника',
//                        [
//                            'class' => 'btn btn-primary',
//                            'id' => 'btn-helper',
//                            'onclick' => "startIntro();",
//                        ]
//                    ) ?>
<!--                    --><?= "" // Html::submitButton(
//                        '<i class="fas fa-comments"></i> Написать куратору',
//                        [
//                            'class' => 'btn bg-indigo',
//                            'id' => 'btn-message',
//                        ]
//                    ) ?>
                    <?php if ($model->filling_step > 7): ?>
                        <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 7])->label(false) ?>
                        <?=
                        Html::submitButton(
                            Icon::show('save') . 'Сохранить заявку',
                            [
                                'class' => 'btn btn-success float-right',
                                'id' => 'btn-save',
                                'value' => 1,
                                'name' => 'save',
                            ]
                        )
                        ?>
                    <?php endif; ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<?php
$goToLastTab = ($model->id) ? 'true' : 'false';

$currentTab = 'tab-user';
switch ($model->filling_step) {
    case 2:
        $currentTab = 'tab-spouse';
        break;
    case 3:
        $currentTab = 'tab-child';
        break;
    /*case 4:
        $currentTab = 'tab-family';
        break;*/
    case 4:
        $currentTab = 'tab-house';
        break;
    case 5:
        $currentTab = 'tab-ipoteka';
        break;
    case 6:
        $currentTab = 'tab-money';
        break;
    case 7:
        $currentTab = 'tab-agreement';
        break;
}

$currentFillingStep = $model->filling_step;



$script = <<< JS
$(document).ready(function() {
    
    localStorage.setItem('lastTab', '$currentTab');
    //alert($currentTab);
    //if ($goToLastTab) {
    //    localStorage.setItem('lastTab', 'tab-agreement');
    //}
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
    
    // Перевключение на Проценты/Заим
    $('#order-is_mortgage').on('change', function() {
        if ($(this).val()==1){
            $('.field-percent').removeClass('d-none');
            $('.field-zaim').addClass('d-none');
        }else{
            $('.field-percent').addClass('d-none');
            $('.field-zaim').removeClass('d-none');
        }
    });
    
    
});





JS;
$this->registerJs($script, yii\web\View::POS_LOAD);

$this->registerCssFile("@web/libs/intro.js/minified/introjs.min.css", ['position' => \yii\web\View::POS_HEAD]);
$this->registerJsFile("@web/libs/intro.js/minified/intro.min.js", ['depends' => [\yii\web\JqueryAsset::class]]);