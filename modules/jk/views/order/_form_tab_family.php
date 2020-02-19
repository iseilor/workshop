
    <?= $form->field($model, 'is_mortgage')->dropDownList(['1' => 'Да', '0' => 'Нет'], ['prompt' => 'Выберите из списка']); ?>
    <?= $form->field($model, 'mortgage_file', ['options' => ['class' => 'form-group hide']])->fileInput()->hint(
        '* Прикрепите кредитный договор с актуальным графиком платежей в формате PDF'
    ); ?>
