<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\zhp\models\Percent */
/* @var $form yii\widgets\ActiveForm */
?>



<?php $form = ActiveForm::begin(); ?>
<div class="card-body">

    <!--
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>
    -->

    <div class="row">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Вы подходите под данную программу</h4>
                <ul>
                    <li>Максимальный размер компенсации процентов в год: 50 000 руб</li>
                    <li>Максимальный срок компенсации процентов: 10 лет</li>
                </ul>
            </div>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'date_birth')->widget(DatePicker::className(),
                [
                    'options' => ['class' => 'form-control'],
                    'dateFormat' => 'dd.MM.yyyy'
                ]) ?>

            <?=$form->field($model, 'gender')->dropDownList([
            'М' => 'М',
            'Ж' => 'Ж',
            ]);?>

            <?= $form->field($model, 'experience')->textInput() ?>

            <?= $form->field($model, 'year')->widget(DatePicker::className(),
                [
                    'options' => ['class' => 'form-control'],
                    'dateFormat' => 'yyyy'
                ]) ?>

            <?= $form->field($model, 'date_pension')->widget(DatePicker::className(),
                [
                    'options' => ['class' => 'form-control'],
                    'dateFormat' => 'dd.MM.yyyy'
                ]) ?>

        </div>

        <div class="col-4">
            <?= $form->field($model, 'family_count')->textInput() ?>

            <?= $form->field($model, 'family_income')->textInput() ?>

            <?= $form->field($model, 'area_total')->textInput() ?>

            <?= $form->field($model, 'area_buy')->textInput() ?>
            <?= $form->field($model, 'cost_total')->textInput() ?>

        </div>
        <div class="col-4">
            <?= $form->field($model, 'cost_user')->textInput() ?>
            <?= $form->field($model, 'bank_credit')->textInput() ?>
            <?= $form->field($model, 'loan')->textInput() ?>
            <?= $form->field($model, 'percent_count')->textInput() ?>
            <?= $form->field($model, 'percent_rate')->textInput() ?>
        </div>
    </div>

    <!--
    <?= $form->field($model, 'compensation_count')->textInput() ?>
    <?= $form->field($model, 'compensation_years')->textInput() ?>
    -->

</div>
<div class="card-footer">
    <?= Html::submitButton('<i class="fas fa-calculator nav-icon"></i> Рассчитать', ['class' => 'btn btn-info']) ?>
    <?= Html::submitButton('<i class="fas fa-save nav-icon"></i> Сохранить', ['class' => 'btn btn-success']) ?>
    <?= Html::submitButton('Отмена', ['class' => 'btn btn-default float-right']) ?>
</div>

<?php ActiveForm::end(); ?>






