<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $stages app\modules\jk\models\OrderStage */
/* @var $user app\modules\user/models/User */

$this->title = Icon::show('check') . 'Жилищная комиссия заяки №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => ['/module/jk']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-primary card-outline card-outline-tabs">

    <?= $this->render('blocks/tabs', ['model' => $model]) ?>

    <div class="card-footer">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($stage, 'comment')->widget(
            Widget::class,
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'fullscreen'
                    ],
                ],
            ]
        ); ?>
        <?= Html::submitButton(Yii::t('app', Icon::show('check') . 'Одобрено выделение МП'),
            ['class' => 'btn btn-success', 'name' => 'status_code', 'value' => 'COMMISSION_YES']) ?>
        <?= Html::submitButton(Yii::t('app', Icon::show('pause') . 'Резерв'),
            ['class' => 'btn btn-warning', 'name' => 'status_code', 'value' => 'RESERVE']) ?>
        <?= Html::submitButton(Yii::t('app', Icon::show('stop') . 'Отказано в выделении МП'),
            ['class' => 'btn btn-danger', 'name' => 'status_code', 'value' => 'COMMISSION_NO']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
