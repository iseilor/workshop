<?php

use app\modules\user\Module;
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\forms\SignupForm */

$this->title = $model->icon . ' ' . Module::t('module', 'Signup');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="card-body">
                <p>Для регистрации на портале необходимо заполнить форму</p>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'verifyCode')->widget(
                    Captcha::className(),
                    [
                        'captchaAction' => '/user/default/captcha',
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-3">{input}</div></div>',
                    ]
                ) ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton($model->icon . ' ' .
                    Module::t('module','Signup'),
                    ['class' => 'btn btn-primary', 'name' => 'signup-button']
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>