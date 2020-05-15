<?php

use app\widgets\DetailViewCheck;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<?= DetailViewCheck::widget([
    'model' => $model,
    'attributes' => [

        [
            'label' => 'Номер заявки',
            'value' => $model->id,
            'check'=>'<input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success"  data-on-text="Верно" data-off-text="НЕ верно">',
            'comment'=> Html::textArea('downloadSourceCode', "", ['id' => 'downloadSourceCode'])

        ]
    ],
]) ?>


<?php
$script = <<< JS
$(document).ready(function() {
   
    $("input[data-bootstrap-switch]").each(function(){
         $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
