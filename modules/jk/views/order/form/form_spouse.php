<?php

$isSpouseClass = 'hide';
if (isset($model->is_spouse) && $model->is_spouse == 1) {
    $isSpouseClass = '';
}
$isChildClass = 'hide';
if (isset($model->child_count) && $model->child_count > 0) {
    $isChildClass = '';
}

?>
<?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет', '2' => 'Разведён(а)'], ['prompt' => 'Выберите из списка']); ?>

<?= $form->field($model, 'spouse_fio', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'spouse_is_dzo', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
    ['1' => 'Да', '0' => 'Нет'],
    ['prompt' => 'Выберите из списка']
); ?>
<?= $form->field($model, 'spouse_is_do', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
    ['1' => 'Да', '0' => 'Нет'],
    ['prompt' => 'Выберите из списка']
); ?>
<?= $form->field($model, 'spouse_is_work', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
    ['1' => 'Да', '0' => 'Нет'],
    ['prompt' => 'Выберите из списка']
); ?>
