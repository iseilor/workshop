<?php

use app\modules\user\models\Spouse;

?>
<?= $form->field($model, 'type')->dropDownList(Spouse::getTypeList()); ?>

<div class="row <?= (isset($model->type) && $model->type == 1) ? 'type-1' : 'type-1 d-none' ?>">
    <?= $form->field($model, 'agreement_ppd')->checkbox(
        ["template" => "<div class='checkbox'>\n{beginLabel}\n{input}\n{labelTitle}\n{endLabel}\n{hint}\n{error}\n</div>"]
    ) ?>
</div>

<?php
$script = <<< JS
$(document).ready(function() {
    $('#spouse-type').on('change', function() {
        switch ($(this).val()) {
          case '0':
                $('.type-1,.type-2').addClass('d-none');
                break;
          case '1':
                $('.type-1').removeClass('d-none');
                break;
          case '2':
              $('.type-1').addClass('d-none');
              $('.type-2').removeClass('d-none');
            break;
        }
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
