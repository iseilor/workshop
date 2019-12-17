<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Percent */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([ 'id' => 'percent-form',]); ?>
<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'date_birth')
                ->widget(DatePicker::className(),
                    [
                        'options' => ['class' => 'form-control'],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]) ?>
            <?= $form->field($model, 'gender')->dropDownList([
                '1' => 'М',
                '0' => 'Ж',
            ]); ?>
            <?= $form->field($model, 'experience')->textInput() ?>
            <?= $form->field($model, 'year')->textInput() ?>
            <?= $form->field($model, 'date_pension')
                ->widget(DatePicker::className(),
                    [
                        'options' => ['class' => 'form-control'],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'family_count')->textInput() ?>
            <?= $form->field($model, 'family_income')->textInput() ?>
            <?= $form->field($model, 'area_total')->textInput() ?>
            <?= $form->field($model, 'area_buy')->textInput() ?>
            <?= $form->field($model, 'cost_total')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'cost_user')->textInput() ?>
            <?= $form->field($model, 'bank_credit')->textInput() ?>
            <?= $form->field($model, 'loan')->textInput() ?>
            <?= $form->field($model, 'percent_count')->textInput() ?>
            <?= $form->field($model, 'percent_rate')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'compensation_result')->textInput() ?>
            <?= $form->field($model, 'compensation_count')->textInput() ?>
            <?= $form->field($model, 'compensation_years')->textInput() ?>
        </div>
    </div>
</div>
<div class="card-footer">
    <?= Html::button('<i class="fas fa-calculator nav-icon"></i> Рассчитать',
        ['class' => 'btn btn-info', 'id' => 'percent-calc']) ?>
    <?= Html::submitButton('<i class="fas fa-save nav-icon"></i> Сохранить',
        ['class' => 'btn btn-success']) ?>
    <?= Html::a(Yii::t('app', 'Отмена'), ['create'],
        ['class' => 'btn btn-default float-right']) ?>
</div>
<?php ActiveForm::end(); ?>