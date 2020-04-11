<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'is_participate')->dropDownList($model->getParticipateList(), ['prompt' => 'Выберите ...']); ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'is_mortgage')->dropDownList($model->getMortgageList(), ['prompt' => 'Выберите ...']); ?>
    </div>
</div>