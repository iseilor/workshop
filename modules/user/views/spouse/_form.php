<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */
/* @var $form yii\widgets\ActiveForm */

// Класс показывать или нет
$d_none0 = (isset($model->type) && $model->type > 0) ? '' : 'd-none';
$d_none1 = (isset($model->type) && $model->type == 1) ? '' : 'd-none';
$d_none2 = (isset($model->type) && $model->type == 2) ? '' : 'd-none';
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
                        <h3><?= Icon::show('check') ?>Наличие супруги(а)</h3>
                        <?= $this->render('form/type', ['model' => $model, 'form' => $form]) ?>
                        <div class="type-1 type-2 <?= $d_none0 ?>">
                            <hr/>
                            <h3><?= Icon::show('user') ?>Общие данные</h3>
                            <?= $this->render('form/general', ['model' => $model, 'form' => $form]) ?>
                        </div>
                        <div class="type-1 <?= $d_none1 ?>">
                            <hr/>
                            <h3><?= Icon::show('map-marker-alt') ?>Адрес</h3>
                            <?= $this->render('form/address', ['model' => $model, 'form' => $form]) ?>
                        </div>
                    </div>
                    <div class="col-md-4 type-1 <?= $d_none1 ?>">
                        <h3><?= Icon::show('address-card') ?>Паспорт</h3>
                        <?= $this->render('form/passport',
                            [
                                'model' => $model,
                                'form' => $form,
                                'user' => $user,
                            ]) ?>
                    </div>
                    <div class="col-md-4 type-1 <?= $d_none1 ?>">
                        <h3><?= Icon::show('briefcase') ?>Трудоустройство</h3>
                        <?= $this->render('form/work', ['model' => $model, 'form' => $form]) ?>
                    </div>
                    <div class="col-md-12 type-1 <?= $d_none1 ?>">
                        <hr/>
                        <h3><?= Icon::show('lock') ?>Персональные данные</h3>
                        <?= $this->render('form/personal', ['model' => $model, 'form' => $form]) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer type-1 type-2 <?= $d_none0 ?>">
                <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>