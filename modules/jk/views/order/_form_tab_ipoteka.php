<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'ipoteka_size')->textInput(); ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'ipoteka_user')->textInput(); ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'ipoteka_params')->textarea(); ?>
    </div>
</div>