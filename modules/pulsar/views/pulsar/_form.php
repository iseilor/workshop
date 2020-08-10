<?php

use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\modules\pulsar\models\Pulsar */
/* @var $form yii\widgets\ActiveForm */

// В текущий день больше нельзя создавать пульсары
$disabled = [];
$disabledStar = false;
if (isset($disable) && $disable) {
    $disabled = ['disabled' => 'disabled'];
    $disabledStar = true;
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        echo $form->field($model, 'health_value')->widget(StarRating::class, [
                            'pluginOptions' => [
                                'size' => 'xl',
                                'theme' => 'krajee-fas',
                                'step' => 1,
                                'showClear' => false,
                                'disabled' => $disabledStar,
                                'starCaptions' => [
                                    1 => 'Госпитализирован в больницу',
                                    2 => 'Болею дома',
                                    3 => 'Испытываю недомогание',
                                    4 => 'Чувствую себя хорошо',
                                    5 => 'Чувствую себя отлично',
                                ],
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'health_comment')->textarea($disabled) ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $form->field($model, 'mood_value')->widget(StarRating::class, [
                            'pluginOptions' => [
                                'size' => 'xl',
                                'theme' => 'krajee-fas',
                                'step' => 1,
                                'showClear' => false,
                                'disabled' => $disabledStar,
                                'starCaptions' => [
                                    1 => 'Готов убивать',
                                    2 => 'Настроение плохое',
                                    3 => 'Настроение удовлетворительное',
                                    4 => 'Настроение хорошее',
                                    5 => 'Настроение отличное',
                                ],
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'mood_comment')->textarea($disabled) ?>
                    </div>
                    <div class="col-md-4">
                        <?php
                        echo $form->field($model, 'job_value')->widget(StarRating::class, [
                            'pluginOptions' => [
                                'size' => 'xl',
                                'theme' => 'krajee-fas',
                                'step' => 1,
                                'showClear' => false,
                                'disabled' => $disabledStar,
                                'starCaptions' => [
                                    1 => 'Не буду работать',
                                    2 => 'Не хочу работать',
                                    3 => 'Удовлетворительная работоспособность',
                                    4 => 'Хорошая работоспособность',
                                    5 => 'Отличная работоспособность',
                                ],
                            ],
                        ]);
                        ?>
                        <?= $form->field($model, 'job_comment')->textarea($disabled) ?>
                    </div>
                </div>
            </div>
            <?php if (!(isset($disable) && $disable)): ?>
                <div class="card-footer">
                    <?= Html::submitButton(\kartik\icons\Icon::show('save') . Yii::t('app', 'Save'),
                        ['class' => 'btn btn-success']) ?>
                </div>
            <?php endif; ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
