<?php

use app\modules\user\models\Spouse;

/**
 *
 */
echo $this->render('@app/modules/user/views/spouse/info');

?>
<!--<div class="row">
    <div class="col-lg-4">
        <?/*= $form->field($spose, 'type')->dropDownList(Spouse::getTypeList()); */?>
    </div>

    <div class="col-lg-4">


    </div>

    <div class="col-lg-4">


    </div>

</div>

    <div class="row">
        <div class="col-lg-4">
            <div class="type-1 type-2">
                <?/*= $form->field($spose, 'fio')->textInput(['maxlength' => true, 'placeholder' => 'Иванова Анастасия Ивановна']) */?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="type-1 type-2">
                <?/*= $form->field($spose, 'gender')->dropDownList($spose->getGenderList(), ['prompt' => 'Выберите ...']); */?>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="type-3">
                <?/*= $form->field($spose, 'marriage_file_form', [
                'template' => getFileInputTemplate($spose->marriage_file,  'Копия.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) */?>
            </div>
        </div>

    </div>-->


<?php if ($model->filling_step == 2): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 2])->label(false) ?>
                </div>
                <div class="col-2">
                    <?= \yii\helpers\Html::submitButton(
                        \kartik\icons\Icon::show('play') . 'Далее',
                        [
                            'class' => 'btn btn-success float-right',
                            'id' => 'btn-save',
                            'value' => 1,
                            'name' => 'save',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php
$script = <<< JS
$(document).ready(function() {
    $('#spouse-type').on('change', function() {
        switch ($(this).val()) {
          case '0':
                $('.type-1,.type-3').addClass('d-none');
                break;
          case '1':
                $('.type-1').removeClass('d-none');
                break;
          case '2':
              $('.type-1').addClass('d-none');
              $('.type-3').removeClass('d-none');
            break;
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>