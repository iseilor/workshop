<?php

/* @var $this yii\web\View */

/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\modules\main\Module;
use yii\helpers\Url;

$this->title = '<i class="fas fa-envelope"></i> ' . Module::t('module', 'Contacts');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
            <div class="alert alert-success">
                Ваше сообщение успешно отправлено<br>
                Пожалуйста, ожидайте, наши специалисты свяжутся с Вами в ближайшее время
            </div>
        <?php else: ?>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-envelope"></i> Форма обратной связи</h3>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="card-body">
                    <p>Если у вас остались какие-то вопросы или пожелания по работе портала <?php echo Html::a(Yii::$app->name, Url::home()); ?>, вы можете связаться с нашими специалистами,
                        воспользовавшись
                        формой обратной связи, представленной ниже:</p>
                    <?= $form->field($model, 'subject') ?>
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'verifyCode')->widget(
                        Captcha::className(),
                        [
                            'captchaAction' => '/main/contact/captcha',
                            'template' => '<div class="row"><div class="col-1">{image}</div><div class="col-2">{input}</div></div>',
                        ]
                    ) ?>
                </div>
                <div class="card-footer">
                    <?= Html::submitButton('<i class="fas fa-envelope"></i> ' . Module::t('module', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
