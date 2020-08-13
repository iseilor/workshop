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
    <div class="col-md-4">
        <?= $form->field($model, 'family_own')->textarea(['rows'=>10]); ?>

        <?= $form->field($model, 'family_deal')->textarea(['rows'=>10]); ?>
    </div>
</div>