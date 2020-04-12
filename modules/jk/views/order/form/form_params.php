<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="row">
    <div class="col-md-6">
    <?=$form->field($model, 'is_agree_personal_data')->checkbox(['label' =>'Я, <u>'. Yii::$app->user->identity->fio.
        '</u>, даю согласие на обработку моих персональных данных'])?>
        <p>Вам необходимо скачать, распечатать, заполнить, подписать и прикрепить в поле ниже файл-шаблон о
        вашем согласии на обработку персональных данных:
        <?=Html::a(\kartik\icons\Icon::show('file-pdf').'Файл-шаблон',Url::to(['/files/jk/doc/1.docx']))?>
        </p>
    <?= $form->field($model, 'file_agree_personal_data_form', [
        'template' => getFileInputTemplate($model->file_agree_personal_data,$model->attributeLabels()['file_agree_personal_data_form'].'.pdf'),
    ])->fileInput(['class' => 'custom-file-input']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'is_participate')->dropDownList($model->getParticipateList(), ['prompt' => 'Выберите ...']); ?>

        <?= $form->field($model, 'is_mortgage')->dropDownList($model->getMortgageList(), ['prompt' => 'Выберите ...']); ?>
    </div>
</div>