<?php

use app\modules\jk\models\ZaimType;
use yii\helpers\ArrayHelper;

$zaim_types = ZaimType::find()->all();
$zaim_types = ArrayHelper::map($zaim_types,'id','title');
$params = [
    'prompt' => 'Укажите тип займа'
];
echo $form->field($model, 'zaim_type')->dropDownList($zaim_types,$params);
?>

<?= $form->field($model,'is_participate')->textInput(['maxlength' => true]) ?>
<?= $form->field($model,'percent_sum')->textarea() ?>
<?= $form->field($model,'target_mortgage')->textInput(['maxlength' => true]) ?>
<?= $form->field($model,'property_type')->textInput(['maxlength' => true]) ?>