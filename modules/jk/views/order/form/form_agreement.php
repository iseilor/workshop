<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use app\modules\jk\models\Order;

$user = User::findOne(Yii::$app->user->identity->id);
?>


<div class="card card-solid card-secondary  ">
    <div class="card-header with-border">
        <h3 class="card-title">Обработка персональных данных</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <h3><?= Yii::$app->user->identity->fio ?></h3>

                <?= $form->field($model, 'file_agree_personal_data_form', [
                    'template' => getFileInputTemplate($model->file_agree_personal_data,
                        $model->attributeLabels()['file_agree_personal_data_form'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                <?= $form->field($model, 'file_agree_personal_data')->hiddenInput()->label(false) ?>
            </div>
        </div>

        <?php if ($spose->type == 1): ?>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <h3><?= $spose->fio ?></h3>
                    <?= $form->field($spose, 'personal_data_file_form', [
                        'template' => getFileInputTemplate($spose->personal_data_file, $spose->attributeLabels()['personal_data_file'] . '.pdf'),
                    ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_array($usermd->children) && count($usermd->children) > 0): ?>
            <?php foreach ($usermd->children as $child): ?>
                <div class="row">
                    <div class="col-md-12">
                        <hr/>
                        <h3><?= $child->fio ?></h3>
                        <?= $form->field($child, 'file_personal_form[' . $child->id . ']', [
                            'template' => getFileInputTemplate($child->file_personal, $child->attributeLabels()['file_personal'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                </div>
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

<?php if ($model->filling_step == 8): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?= $form->field($model, 'filling_step')->hiddenInput(['value' => 8])->label(false) ?>
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
   
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
