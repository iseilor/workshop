<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use app\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $model->icon . ' ' . Module::t('module', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> Корпоративная учётная запись</h3>
            </div>
            <?php $form = ActiveForm::begin(
                [
                    'id' => 'login-form',
                ]
            ); ?>
            <div class="card-body">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(
                    $model->icon . ' ' . Module::t('module', 'Login'),
                    [
                        'class' =>
                            'btn btn-primary',
                        'name'
                        => 'login-button'
                    ]
                ) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>