<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use app\modules\jk\models\Status;

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use app\modules\jk\models\Order;
use yii\helpers\ArrayHelper;

$user = User::findOne(Yii::$app->user->identity->id);
$statuses = ['COMMISSION_YES', 'DOC', 'FINISH'];
?>

<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> Информация</h5>
    Прежде чем приступить к автоматическому формированию заявлений, вам необходимо обязательно сохранить все введенные вами данные
</div>


<div class="card card-solid card-secondary">
    <div class="card-header with-border">
        <h3 class="card-title">Обработка персональных данных</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <h3><?= $usermd->fio ?></h3>

                <?= $form->field($model, 'file_agree_personal_data_form', [
                    'template' => getFileInputTemplate($model->file_agree_personal_data,
                        $model->attributeLabels()['file_agree_personal_data_form'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                <?= $form->field($model, 'file_agree_personal_data')->hiddenInput()->label(false) ?>
            </div>
        </div>

        <?php if ($spouse && $spouse->type == 1): ?>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <h3><?= $spouse->fio ?></h3>
                    <?= $form->field($spouse, 'personal_data_file_form', [
                        'options'=> ['class' => 'required'],
                        'template' => getFileInputTemplate($spouse->personal_data_file, $spouse->attributeLabels()['personal_data_file'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input', 'required' => !$spouse->personal_data_file]) ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_array($usermd->children) && count($usermd->children) > 0): ?>
            <?php foreach ($usermd->children as $child): ?>
                <?php if (!isset($child->deleted_at)): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <hr/>
                            <h3><?= $child->fio ?></h3>
                            <?= $form->field($child, 'file_personal_form[' . $child->id . ']', [
                                'options'=> ['class' => 'required'],
                                'template' => getFileInputTemplate($child->file_personal, $child->attributeLabels()['file_personal'] . '.pdf'),
                            ])->fileInput(['class' => 'custom-file-input', 'required' => !$child->file_personal]) ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Заявление-->
        <div class="row">
            <div class="col-md-12">
                <hr>
                <h3><?= Icon::show('file-pdf') ?>Заявление о предоставлении помощи в улучшении жилищных условий</h3>
                <?= $form->field($model, 'order_file_form', [
                    'template' => getFileInputTemplate(
                        $model->order_file,
                        $model->attributeLabels()['order_file_form'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input'])?>
                <?= $form->field($model, 'order_file')->hiddenInput()->label(false) ?>
            </div>
        </div>

    </div>
</div>

<?php if (in_array($model->status_id, ArrayHelper::getColumn(Status::find()->where(['in','code', $statuses])->all(), 'id'))): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-header with-border">
            <h3 class="card-title">Документы</h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'docs_egrn_file_form', [
                        'template' => getFileInputTemplate($model->docs_egrn_file,
                            $model->attributeLabels()['docs_egrn_file_form'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                    <?= $form->field($model, 'docs_egrn_file')->hiddenInput()->label(false) ?>
                </div>
            </div>
            <div class="row loan <?= $field_zaim ?>">
                <div class="col-md-12">
                    <?= $form->field($model, 'docs_loan_agreement_file_form', [
                        'template' => getFileInputTemplate($model->docs_loan_agreement_file,
                            $model->attributeLabels()['docs_loan_agreement_file_form'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>
            <div class="row additional <?= $field_percent ?>">
                <div class="col-md-12">
                    <?= $form->field($model, 'docs_additional_agreement_file_form', [
                        'template' => getFileInputTemplate($model->docs_additional_agreement_file,
                            $model->attributeLabels()['docs_additional_agreement_file_form'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($model->filling_step == 7): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?= $form->field($model, 'filling_step')->hiddenInput(['value' => 7])->label(false) ?>
                </div>
                <div class="col-2">
                    <?= \yii\helpers\Html::submitButton(
                        \kartik\icons\Icon::show('save') . 'Сохранить заявку',
                        [
                            'class' => 'btn btn-success float-right',
                            'id' => 'btn-save',
                            'value' => 1,
                            'name' => 'save',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php
$script = <<< JS
$(document).ready(function() {
    
    $('div.field-order-file_agree_personal_data_form').addClass('required');
    $('div.field-order-order_file_form').addClass('required');
   
    $('#order-is_mortgage').on('change', function() {
        if ($(this).val() == 0) {
            $('.loan').removeClass('d-none');
            $('.additional').addClass('d-none');
        } else if ($(this).val() == 1) {
            $('.loan').addClass('d-none');
            $('.additional').removeClass('d-none');
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
