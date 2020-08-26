<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h3><?= Icon::show('baby') ?>Общие данные</h3>
                        <?= $this->render('form/general', ['model' => $model, 'form' => $form]) ?>
                        <div class="passport-block <?= (isset($model->date) && $model->age >= 14) ? '' : 'd-none'; ?>">
                            <hr/>
                            <h3><?= Icon::show('address-card') ?>Паспортные данные</h3>
                            <?= $this->render('form/passport', ['model' => $model, 'form' => $form]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3><?= Icon::show('address-book') ?>Свидетельство о рождении</h3>
                        <?= $this->render('form/birth', ['model' => $model, 'form' => $form]) ?>
                        <div class="study-block <?= (isset($model->date) && $model->age >= 18) ? '' : 'd-none'; ?>">
                            <hr/>
                            <h3><?= Icon::show('user-graduate') ?>Студент</h3>
                            <?= $this->render('form/study', ['model' => $model, 'form' => $form]) ?>
                        </div>
                        <div class="invalid-block <?= (isset($model->date) && $model->age >= 18) ? '' : 'd-none'; ?>">
                            <hr/>
                            <h3><?= Icon::show('wheelchair') ?>Инвалид</h3>
                            <?= $this->render('form/invalid', ['model' => $model, 'form' => $form]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h3><?= Icon::show('map-marker-alt') ?>Адрес</h3>
                        <?= $this->render('form/address',
                            [
                                'model' => $model,
                                'form' => $form,
                                'user' => $user,
                                'spouse' => $spouse,
                            ]) ?>
                    </div>
                    <!--<div class="col-md-12">
                        <hr/>
                        <h3><?/*= Icon::show('lock') */?>Обработка персональных данных</h3>
                        <blockquote>
                            <p>
                                Заполните все поля формы по вашему ребёнку выше. Проверьте введённые данные и сохраните их.
                                После этого повторно откройте форму регистрации данных по ребёнку и скачайте автоматически
                                сформированный блан, который нужно будет распечатать, подписать и прикрепить в поле ниже<br/>
                                <?/*= Html::a(Icon::show('file-pdf') . 'Согласие на обработку персональных данных по ребёнку',
                                    Url::to(['/user/child/' . $model->id . '/pd'])) */?><br/>
                            </p>
                        </blockquote>
                        <?/*= $form->field($model, 'file_personal_form', [
                            'template' => getFileInputTemplate($model->file_personal, $model->attributeLabels()['file_personal'] . '.pdf'),
                        ])->fileInput(['class' => 'custom-file-input']) */?>
                    </div>-->
                </div>
            </div>
            <div class="card-footer">
                <?= Html::submitButton(Icon::show('save') . Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
