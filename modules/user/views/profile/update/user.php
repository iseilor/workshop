<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'email')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'position')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_department')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_department_full')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_address')->textInput(['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'work_phone')->textInput(['disabled' => 'disabled']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'tab_number')->textInput() ?>
        <?= $form->field($model, 'experience')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['experience']]) ?>
        <?= $form->field($model, 'work_is_young')->checkbox(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['work_is_young']]) ?>
        <?= $form->field($model, 'work_is_transferred')->checkbox(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['work_is_transferred']]) ?>
    </div>
</div>