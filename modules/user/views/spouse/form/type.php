<?php

use app\modules\user\models\Spouse;

?>
<?= $form->field($model, 'type')->dropDownList(Spouse::getTypeList()); ?>

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
