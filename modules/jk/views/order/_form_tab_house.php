<?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'spouse_fio')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'is_spouse_dzo')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'child_count')->textInput(['maxlength' => true]) ?>