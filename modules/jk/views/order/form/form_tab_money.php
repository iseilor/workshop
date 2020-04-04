<?php

use yii\widgets\MaskedInput;

?>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($model, 'money_oklad')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_summa_year')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_nalog_year')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($model, 'money_month_pay')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
        <?= $form->field($model, 'money_my_pay')->widget(MaskedInput::className(), ['clientOptions' => Yii::$app->params['widget']['MaskedInput']['clientOptionsMoney']]) ?>
    </div>
</div>