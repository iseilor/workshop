<?php
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */


use app\modules\jk\models\Order;
use app\modules\jk\models\Social;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

?>

<div class="row">
    <div class="col-md-4">

        <?php
            $socials = Social::find()->all();
            $items = ArrayHelper::map($socials, 'id', 'title');
            $params = ['prompt' => 'Выберите'];
            echo $form->field($model, 'social_id')->dropDownList($items, $params);
        ?>
        <?= $form->field($model, 'file_family_big_form', [
            'template' => getFileInputTemplate($model->file_family_big, $model->attributeLabels()['file_family_big'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>



    </div>
    <div class="col-md-4">
        <?= "" //$form->field($model, 'resident_own')->textInput(); ?>
        <?= $form->field($model, 'family_rent')->textarea(['rows'=>5]); ?>

    </div>
</div>


<?php if ($model->filling_step == 4): ?>
    <div class="card card-solid card-secondary  ">
        <div class="card-body">
            <div class="row">
                <div class="col-10">
                    <?=  $form->field($model, 'filling_step')->hiddenInput(['value' => 4])->label(false) ?>
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
    $('div.field-order-social_id').addClass('required');
    $('div.field-order-family_own').addClass('required');
    $('div.field-order-family_deal').addClass('required');
});
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>