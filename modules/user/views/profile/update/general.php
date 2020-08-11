<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\MaskedInput;

?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'photo')->fileInput() ?>
        <?php
        $imgThumb = Html::img($model->photo, ['height' => '250', 'class' => 'img-circle','style'=>'border:3px solid #adb5bd; padding: 5px;']);
        $imgOrigPath = str_replace('thumb','orig',$model->photo);
        echo Html::a($imgThumb,$imgOrigPath,['data-toggle'=>'lightbox','data-title'=>$model->fio,'title'=>$model->fio]);
        ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
        <?= $form->field($model, 'gender')->dropDownList(
            [
                '1' => 'Мужской',
                '0' => 'Женский',
            ],
            ['prompt' => 'Выберите из списка']
        ); ?>
        <?= $form->field($model, 'birth_date')->widget(
            DatePicker::classname(),
            [
                'language' => 'ru',
                'dateFormat' => 'dd.MM.yyyy',
                'options' => ['class' => 'form-control inputmask-date'],
                'clientOptions' => [
                    'changeMonth' => true,
                    'yearRange' => '1950:2002',
                    'changeYear' => true
                ],
            ]
        ) ?>
        <?= $form->field($model, 'experience')->widget(MaskedInput::class, [
            'mask' => '9[9]',
            'clientOptions' => [
                'clearIncomplete' => true
            ]
        ]) ?>
    </div>
</div>