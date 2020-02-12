<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-ruble-sign"></i> Оформление заявки на участие в Жилищной Кампании</h3>
            </div>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'is_mortgage')->dropDownList(['1' => 'Да','0' => 'Нет'],['prompt' => 'Выберите из списка']); ?>
                        <?= $form->field($model, 'mortgage_file')->fileInput()->hint('* Прикрепите кредитный договор с актуальным графиком платежей в формате PDF'); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да','0' => 'Нет'],['prompt' => 'Выберите из списка']); ?>
                        <?= $form->field($model, 'spouse_fio')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'is_spouse_dzo')->dropDownList(['1' => 'Да','0' => 'Нет'],['prompt' => 'Выберите из списка']); ?>
                        <?= $form->field($model, 'child_count')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

            </div>
            <div class="card-footer">

                <?= Html::submitButton(
                    '<i class="fas fa-save"></i> Сохранить заявку',
                    [
                        'class' => 'btn btn-info',
                        'id' => 'btn-save',
                    ]
                ) ?>
                <?= Html::submitButton(
                    '<i class="fas fa-user-check"></i> Отправить заявку на проверку куратору',
                    [
                        'class' => 'btn btn-success',
                        'id' => 'btn-save',
                    ]
                ) ?>


                <?= Html::a(
                    Yii::t('app', 'Отмена'),
                    ['create'],
                    ['class' => 'btn btn-default float-right']
                ) ?>


            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
