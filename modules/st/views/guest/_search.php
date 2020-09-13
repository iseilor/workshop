<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\st\models\GuestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="guest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'deleted_at') ?>

    <?php // echo $form->field($model, 'deleted_by') ?>

    <?php // echo $form->field($model, 'curator_id') ?>

    <?php // echo $form->field($model, 'guest_fio') ?>

    <?php // echo $form->field($model, 'guest_category') ?>

    <?php // echo $form->field($model, 'guest_photo') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'annotation') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'registration_link') ?>

    <?php // echo $form->field($model, 'webinar_link') ?>

    <?php // echo $form->field($model, 'youtube_link') ?>

    <?php // echo $form->field($model, 'vk_link') ?>

    <?php // echo $form->field($model, 'telegram_link') ?>

    <?php // echo $form->field($model, 'video') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'color') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
