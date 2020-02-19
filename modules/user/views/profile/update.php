<?php

use app\modules\user\Module;

use kartik\file\FileInput;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */
/* @var $socials app\modules\admin\models\UserSocial */

$this->title = '<i class="fas fa-user-edit"></i> ' . Module::t('module', 'Profile Update');
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-user"></i> ' . Module::t('module', 'Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary card-outline card-outline-tabs" style="border-top: none;">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1">
                    <i class="fas fa-user"></i> Общие данные</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2"
                   aria-selected="true">
                    <i class="fas fa-user-tie"></i> Сотрудник
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3"
                   aria-selected="true">
                    <i class="far fa-address-card"></i> Паспорт
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4"
                   aria-selected="true">
                    <i class="far fa-id-card"></i> СНИЛС
                </a>
            </li>
        </ul>
    </div>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">

                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($model, 'photo')->fileInput() ?>
                        <?php
                        $imgThumb = Html::img($model->photo, ['height' => '250', 'class' => 'img-circle','style'=>'border:3px solid #adb5bd; padding: 5px;']);
                        $imgOrigPath = str_replace('thumb','orig',$model->photo);
                        echo Html::a($imgThumb,$imgOrigPath,['data-toggle'=>'lightbox','data-title'=>$model->fio,'title'=>$model->fio]);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'fio')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'gender')->dropDownList(
                            [
                                '1' => 'Мужской',
                                '0' => 'Женский',
                            ],
                            ['prompt' => 'Выберите из списка']
                        ); ?>
                        <?= $form->field($model, 'birth_date')->widget(
                            DatePicker::classname(),
                            [
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    'changeMonth' => true,
                                    'yearRange' => '1950:2002',
                                    'changeYear' => true
                                ],
                            ]
                        ) ?>
                    </div>
                </div>

            </div>
            <!-- Сотрудник -->
            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'email')->textInput(['disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'position')->textInput(['disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'work_department')->textInput(['disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'work_department_full')->textInput(['disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'work_address')->textInput(['disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'work_phone')->textInput(['disabled' => 'disabled']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'experience')->textInput(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['experience']]) ?>
                        <?= $form->field($model, 'user_social_id')->dropDownList(ArrayHelper::map($socials, 'id', 'title'), ['prompt' => 'Выберите...']) ?>
                        <?= $form->field($model, 'work_is_young')->checkbox(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['work_is_young']]) ?>
                        <?= $form->field($model, 'work_is_transferred')->checkbox(['data-toggle' => "tooltip", 'title' => $model->attributeDescription()['work_is_transferred']]) ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        $passportFile = '';
                        if ($model->passport_file) {
                            $passportFile = 'Паспорт: ' . Html::a(
                                    Yii::$app->params['module']['user']['passport']['icon'] . ' Мой паспорт',
                                    Yii::$app->homeUrl . Yii::$app->params['module']['user']['passport']['path'] . $model->passport_file,
                                    ['target' => '_blank']
                                );
                        }
                        ?>
                        <?= $form->field($model, 'passport_file')->fileInput()->hint($passportFile) ?>
                        <?= $form->field($model, 'passport_series')->textInput() ?>
                        <?= $form->field($model, 'passport_number')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'passport_department')->textInput() ?>
                        <?= $form->field($model, 'passport_date')->widget(
                            DatePicker::classname(),
                            [
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    'changeMonth' => true,
                                    'yearRange' => '1950:2020',
                                    'changeYear' => true
                                ],
                            ]
                        ) ?>
                        <?= $form->field($model, 'passport_code')->textInput() ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'passport_registration')->textInput() ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        $snilsFile = '';
                        if ($model->passport_file) {
                            $passportFile = 'СНИСЛ: ' . Html::a(
                                    Yii::$app->params['module']['user']['snils']['icon'] . ' Мой СНИЛС',
                                    Yii::$app->homeUrl . Yii::$app->params['module']['user']['snils']['path'] . $model->snils_file,
                                    ['target' => '_blank']
                                );
                        }
                        ?>
                        <?= $form->field($model, 'snils_file')->fileInput()->hint($passportFile) ?>
                        <?= $form->field($model, 'snils_number')->textInput() ?>
                        <?= $form->field($model, 'snils_date')->widget(
                            DatePicker::classname(),
                            [
                                'language' => 'ru',
                                'dateFormat' => 'dd.MM.yyyy',
                                'options' => ['class' => 'form-control'],
                                'clientOptions' => [
                                    'changeMonth' => true,
                                    'yearRange' => '1950:2020',
                                    'changeYear' => true
                                ],
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton('<i class="fas fa-save"></i> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>