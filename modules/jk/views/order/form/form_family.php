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
        <?= $form->field($model, 'resident_count')->textInput(); ?>
        <?=$form->field($model, 'resident_type')->dropDownList(Order::getResidentTypeList(),  ['prompt' => 'Выберите']); ?>
        <?= $form->field($model, 'file_family_big_form', [
            'template' => getFileInputTemplate($model->file_family_big, $model->attributeLabels()['file_family_big'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
        <?= $form->field($model, 'file_social_protection_form', [
            'template' => getFileInputTemplate($model->file_social_protection, $model->attributeLabels()['file_social_protection'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'family_address')->textarea(); ?>
        <?= $form->field($model, 'resident_own')->textInput(); ?>
        <?= $form->field($model, 'file_rent_form', [
            'template' => getFileInputTemplate($model->file_rent, $model->attributeLabels()['file_rent'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
        <?= $form->field($model, 'file_social_contract_form', [
            'template' => getFileInputTemplate($model->file_social_contract, $model->attributeLabels()['file_social_contract'] . '.pdf'),
        ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'family_own')->textarea(); ?>
        <?= $form->field($model, 'family_rent')->textarea(); ?>
        <?= $form->field($model, 'family_deal')->textarea(); ?>
    </div>
</div>