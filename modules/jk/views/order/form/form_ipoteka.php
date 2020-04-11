<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_target')->dropDownList($model->getIpotekaTargetList(), ['prompt' => 'Выберите ...']); ?>
        <?= $form->field($model, 'ipoteka_size')->textInput(); ?>
        <?= $form->field($model, 'ipoteka_user')->textInput(); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_params')->textarea(); ?>
        <?= $form->field($model, 'ipoteka_summa')->textarea(); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_file_dogovor_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_dogovor,$model->attributeLabels()['ipoteka_file_dogovor'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>

        <?= $form->field($model, 'ipoteka_file_grafic_first_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_grafic_first,$model->attributeLabels()['ipoteka_file_grafic_first'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>

    </div>


    <div class="col-md-6">

    </div>
    <div class="col-md-6">

    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_file_grafic_now_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_grafic_now,$model->attributeLabels()['ipoteka_file_grafic_now'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
        <?= $form->field($model, 'ipoteka_file_refenance_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_refenance,$model->attributeLabels()['ipoteka_file_refenance'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_file_spravka_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_spravka,$model->attributeLabels()['ipoteka_file_spravka'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
        <?= $form->field($model, 'ipoteka_file_bank_approval_form', [
            'template' => getFileInputTemplate($model->ipoteka_file_bank_approval,$model->attributeLabels()['ipoteka_file_bank_approval'].'.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
</div>