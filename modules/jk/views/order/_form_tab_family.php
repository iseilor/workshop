<?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет', '2'=>'Разведён(а)'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'spouse_fio')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'spouse_is_dzo')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'spouse_is_do')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'spouse_is_work')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
<?= $form->field($model, 'child_count')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'child_count_18')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'child_count_23')->textInput(['maxlength' => true]) ?>