<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3><?=Icon::show('user')?>Общие данные</h3>
                        <?= $this->render('form/general', ['model' => $model, 'form' => $form]) ?>
                        <hr/>
                        <h3><?=Icon::show('map-marker-alt')?>Адрес</h3>
                        <?= $this->render('form/address', ['model' => $model, 'form' => $form]) ?>
                    </div>
                    <div class="col-md-4">
                        <h3><?=Icon::show('address-card')?>Паспорт</h3>
                        <?= $this->render('form/passport', ['model' => $model, 'form' => $form]) ?>
                    </div>
                    <div class="col-md-4">
                        <h3><?=Icon::show('briefcase')?>Трудоустройство</h3>
                        <?= $this->render('form/work', ['model' => $model, 'form' => $form]) ?>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                        <h3><?=Icon::show('lock')?>Персональные данные</h3>
                        <?= $this->render('form/personal', ['model' => $model, 'form' => $form]) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                    <?= Html::submitButton(Icon::show('save').Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>