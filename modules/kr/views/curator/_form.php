<?php

use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\kr\models\Curator */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?=$this->title?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
               <img src="<?= Url::home().Yii::$app->params['module']['kr']['curator']['path'].$model->img?>" class="img-circle img-fluid" style="max-width: 250px;">
                <?= $form->field($model, 'img_form')->fileInput()->hint('Фотографию обязательно грузите с одинаковыми размерами по ширине и высоте
                (квадратная), в противном случае область лица может неккоректно определиться системой, либо будет построена кривая окружность') ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                    'mask' => '8 999 999 99 99',
                    'clientOptions' => [
                        'clearIncomplete' => true,
                    ],
                ]) ?>
                <?= $form->field($model, 'block_id')->dropDownList(ArrayHelper::map(\app\modules\kr\models\Block::find()->all(), 'id', 'title'), ['prompt' => 'Выберите...']); ?>
                <?= $form->field($model, 'weight')->textInput() ?>
            </div>
            <div class="col-4">
                <?= $form->field($model, 'description')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 400,
                            'plugins' => [
                                'clips',
                                'fullscreen',
                            ],
                        ],
                    ]
                ); ?>
            </div>


        </div>
    </div>
    <div class="card-footer">
        <?= Html::submitButton(Icon::show('save').Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
