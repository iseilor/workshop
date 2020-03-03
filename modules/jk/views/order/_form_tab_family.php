<?php
$isSpouseClass = 'hide';
if (isset($model->is_spouse) && $model->is_spouse==1){
    $isSpouseClass = '';
}
$isChildClass = 'hide';
if (isset($model->child_count) && $model->child_count>0){
    $isChildClass = '';
}

use yii\widgets\MaskedInput; ?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет', '2' => 'Разведён(а)'], ['prompt' => 'Выберите из списка']); ?>
        <?= $form->field($model, 'spouse_fio',['options'=>['class'=>'form-group is-spouse '.$isSpouseClass]])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'spouse_is_dzo',['options'=>['class'=>'form-group is-spouse '.$isSpouseClass]])->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
        <?= $form->field($model, 'spouse_is_do',['options'=>['class'=>'form-group is-spouse '.$isSpouseClass]])->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
        <?= $form->field($model, 'spouse_is_work',['options'=>['class'=>'form-group is-spouse '.$isSpouseClass]])->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'child_count')->widget(MaskedInput::className(), ['mask' => '9']) ?>
        <?= $form->field($model, 'child_count_18',['options'=>['class'=>'form-group is-child '.$isChildClass]])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'child_count_23',['options'=>['class'=>'form-group is-child '.$isChildClass]])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
        <div class="form-group field-order-child_count">
            <label class="control-label" for="order-child_count">Дети</label>
            <div class="help-block">* Вся таблица с детьми должны быть заполнена</div>
        </div>
    </div>

</div>