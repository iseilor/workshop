<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_target')->dropDownList($model->getIpotekaTargetList(), ['prompt' => 'Выберите ...']); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_size')->textInput(); ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'ipoteka_user')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'ipoteka_params')->textarea(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'ipoteka_summa')->textarea(); ?>
    </div>
    <div class="col-md-12">
        <!--<div class="form-group">
            <label for="exampleInputFile">File input</label>
            <div class="input-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" title="dsf">
                    <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                </div>
            </div>
        </div>-->
        <?= $form->field($model, 'ipoteka_file_dogovor')->fileInput() ?>
        <?= $form->field($model, 'ipoteka_file_grafic_first')->fileInput() ?>
        <?= $form->field($model, 'ipoteka_file_grafic_now')->fileInput() ?>
        <?= $form->field($model, 'ipoteka_file_refenance')->fileInput() ?>
        <?= $form->field($model, 'ipoteka_file_spravka')->fileInput() ?>
        <?= $form->field($model, 'ipoteka_file_bank_approval')->fileInput() ?>
    </div>
</div>