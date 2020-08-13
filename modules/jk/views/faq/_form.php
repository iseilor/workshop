<?php

use app\modules\jk\models\Faq;
use vova07\imperavi\Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-question"></i> Вопрос</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>

            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">


                <?= $form->field($model, 'question')->textInput(['maxlength' => true]) ?>

                <?php
                $faqs = ArrayHelper::map(Faq::find()->where('faq_id is null')->published()->all(), 'id', 'question');
                $params = [
                    'prompt' => 'Укажите родительский вопрос',
                    'class' => 'form-control select2',
                ];
                echo $form->field($model, 'faq_id')->dropDownList($faqs, $params);
                ?>

                <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'answer')->widget(
                    Widget::class,
                    [
                        'settings' => [
                            'lang' => 'ru',
                            'minHeight' => 100,
                            'plugins' => [
                                'clips',
                                'fullscreen',
                            ],
                            'clips' => [
                                ['Lorem ipsum...', 'Lorem...'],
                                ['red', '<span class="label-red">red</span>'],
                                ['green', '<span class="label-green">green</span>'],
                                ['blue', '<span class="label-blue">blue</span>'],
                            ],
                        ],
                    ]
                ); ?>


            </div>
            <div class="card-footer">

                <?= Html::submitButton(
                    '<i class="fas fa-save nav-icon"></i> Сохранить',
                    [
                        'class' => 'btn btn-success',
                        'id' => 'btn-save',
                    ]
                ) ?>


                <?= Html::a(
                    Yii::t('app', 'Отмена'),
                    ['create'],
                    ['class' => 'btn btn-default float-right']
                ) ?>


            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
