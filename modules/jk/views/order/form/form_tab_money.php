<?php

use yii\widgets\MaskedInput;

?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'salary')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'total_sum_income')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'total_sum_nalog')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'month_pay')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'month_my_pay')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
</div>