<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
$icon = '<i class="fas fa-sign-in"></i>';
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $icon ?> <?= Html::encode($this->title) ?></h3>
            </div>

            <?php $form = ActiveForm::begin([
                                                'id' => 'login-form',
                                            ]); ?>

            <div class="card-body">

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox([
                                                                     'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                                                 ]) ?>
            </div>
            <div class="card-footer">


                <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name'
                => 'login-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>