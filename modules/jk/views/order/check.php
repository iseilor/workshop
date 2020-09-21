<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order app\modules\jk\models\Order */
/* @var $stages app\modules\jk\models\OrderStage */
/* @var $user app\modules\user/models/User */

$this->title = Icon::show('check') . 'Проверка заявки №' . $order->id;
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => ['/module/jk']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$passportPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['passport']['path'] . $user->passport_file;
$snilsPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['snils']['path'] . $user->snils_file;

?>
<div class="card card-primary card-outline card-outline-tabs">

    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab"
                   aria-controls="custom-tabs-three-home" aria-selected="true">
                    <?= Icon::show('list') ?>Основные параметры заявки
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab"
                   aria-controls="custom-tabs-three-profile" aria-selected="false">
                    <?= Icon::show('history') ?>История работы над заявкой
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-three-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                <?= DetailView::widget(
                    [
                        'model' => $order,
                        'attributes' => [
                            [
                                'format' => 'raw',
                                'label' => 'Заявка',
                                'value' => Html::a('№28 (Открыть заявку на просмотр в отдельном окне ' . Icon::show('external-link-alt').')',
                                    ['/jk/order/' . $order->id], ['target' => '_blank']),
                            ],
                            'created_at:datetime',
                            'createdUserLink:html',
                            'createdUser.position',
                            'createdUser.work_department_full',
                            'createdUser.work_address',
                            'typeName',
                            'status.label:html',
                        ],
                    ]
                ) ?>
            </div>
            <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                <?= GridView::widget([
                    'dataProvider' => $stages,
                    'pager' => [
                        'class' => 'app\widgets\LinkPager',
                    ],
                    'columns' => [
                        'created_at:datetime',
                        'createdUserLink:html',
                        'status.label:html',
                        'comment:html',

                    ],
                ]) ?>
            </div>
        </div>
    </div>


    <div class="card-footer">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <?= $form->field($stage, 'comment')->widget(
            Widget::class,
            [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 200,
                    'plugins' => [
                        'clips',
                        'fullscreen',
                    ],
                ],
            ]
        ); ?>

        <?= Html::submitButton(Yii::t('app', Icon::show('check') . 'Проверено и согласовно'),
            ['class' => 'btn btn-success', 'name' => 'status_code', 'value' => 'COMMISSION_WAIT']) ?>
        <?= Html::submitButton(Yii::t('app', Icon::show('undo') . 'Вернуть для исправления'),
            ['class' => 'btn btn-warning', 'name' => 'status_code', 'value' => 'CURATOR_RETURN']) ?>
        <?= Html::submitButton(Yii::t('app', Icon::show('stop') . 'Отказать в помощи'),
            ['class' => 'btn btn-danger', 'name' => 'status_code', 'value' => 'CURATOR_NO']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>
