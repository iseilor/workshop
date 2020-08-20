<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\MaskedInput;

?>
<div class="row">
    <div class="col-md-6">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Информация</h5>
            Поля ниже заполняются в автоматическом режиме из <strong>Active Directory</strong>. Если вы видите, что
            какие-то данные по вам заполнены не верно, вам необходимо обратиться
            к администратору Active Directory в вашем филиале, лучше это сделать через портал
            <?= Html::a('helpme.rt.ru', Url::to('https://helpeme.rt.ru'), ['target' => '_blank']) ?>
        </div>
        <?= $form->field($model, 'email')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'position')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_department')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_department_full')->textarea(['disabled' => 'disabled','rows'=>3]) ?>
        <?= $form->field($model, 'work_address')->textarea(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_phone')->textInput(['disabled' => 'disabled']) ?>
    </div>
    <div class="col-md-6">
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-info"></i> Информация</h5>
            Данные поля заполняются сотрудником самостоятельно и обязательны для заполнения при работе с порталом
        </div>
        <?= $form->field($model, 'tab_number')->textInput() ?>
        <?= $form->field($model, 'work_is_young')->checkbox(
            ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
        ) ?>
        <?= $form->field($model, 'work_is_transferred')->checkbox(
            ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
        ) ?>
        <?= $form->field($model, 'work_transferred_file', [
            'options' => ['class' => (!$model->work_is_transferred) ? 'd-none':''],
            'template' => getFileInputTemplate($model->work_transferred_file, $model->attributeLabels()['work_transferred_file'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    
    // Поле с заявлением о переводе показываем, когда включена галочка
    $('#profileupdateform-work_is_transferred').on('click', function() {
        $('.field-profileupdateform-work_transferred_file').toggleClass('d-none');
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>