<?php

use app\modules\project\models\Project;
use app\modules\project\models\TaskStatus;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\project\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card">


    <?php $form = ActiveForm::begin(); ?>


    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <?php
                $projects = ArrayHelper::map(Project::find()->all(), 'id', 'title');
                $params = [
                    'prompt' => 'Укажите проект',
                    'class' => 'form-control select2',
                ];
                echo $form->field($model, 'project_id')->dropDownList($projects, $params);
                ?>
            </div>
            <div class="col-md-3">
                <?php
                $statuses = ArrayHelper::map(TaskStatus::find()->all(), 'id', 'title');
                $params = [
                    'prompt' => 'Укажите статус задачи',
                    'class' => 'form-control select2',
                ];
                echo $form->field($model, 'status_id')->dropDownList($statuses, $params);
                ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'progress')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'rfc')->textInput() ?>
            </div>
        </div>

        <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

        <!--<?= $form->field($model, 'user_id')->textInput() ?>

        <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>-->
    </div>

    <div class="card-footer">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>