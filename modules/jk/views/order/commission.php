<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use vova07\imperavi\Widget;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\modules\jk\models\OrderStageSearch;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Order */
/* @var $stage app\modules\jk\models\OrderStage */
/* @var $user app\modules\user/models/User */

$this->title = Icon::show('check-double') . 'Решение жилищной комиссии по заяке №' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => ['/module/jk']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="card card-primary card-outline card-outline-tabs">

        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-1" data-toggle="pill" href="#tab-1-body" role="tab" aria-controls="tab-1-body"
                       aria-selected="true">
                        <?= Icon::show('check-double') ?>Решение комиссии
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab"
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
                <div class="tab-pane fade active show" id="tab-1-body" role="tabpanel" aria-labelledby="tab-1">
                    <div class="row">
                        <div class="col-4">
                            <?php if ($model->is_mortgage): ?>
                                <?= $form->field($stage, 'field1')->textInput()->label('Размер %'); ?>
                                <?= $form->field($stage, 'field2')->textInput()->label('Срок выплат, лет'); ?>
                                <?= $form->field($stage, 'field3')->textInput()->label('Период выплат'); ?>
                                <?= $form->field($stage, 'field4')->textInput()->label('Максимальная сумма выплат в целом, руб'); ?>
                                <?= $form->field($stage, 'field5')->textInput()->label('Максимальная сумма выплат в год, руб'); ?>
                            <?php else: ?>
                                <?= $form->field($stage, 'field1')->textInput()->label('Размер займа, руб'); ?>
                                <?= $form->field($stage, 'field2')->textInput()->label('Срок займа, лет'); ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($stage, 'comment')->label('Комментарий куратора')->widget(
                                Widget::class,
                                [
                                    'settings' => [
                                        'lang' => 'ru',
                                        'minHeight' => 200,
                                        'plugins' => [
                                            'fullscreen',
                                        ],
                                    ],
                                ]
                            ); ?>
                        </div>
                        <div class="col-4">
                            <?= $form->field($stage, 'comment2')->label('Дополнительные документы')->widget(
                                Widget::class,
                                [
                                    'settings' => [
                                        'lang' => 'ru',
                                        'minHeight' => 200,
                                        'plugins' => [
                                            'fullscreen',
                                        ],
                                    ],
                                ]
                            ); ?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade " id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <?= DetailView::widget(
                        [
                            'model' => $model,
                            'attributes' => [
                                [
                                    'format' => 'raw',
                                    'label' => 'Заявка',
                                    'value' => Html::a('№' . $model->id . ' (Открыть заявку на просмотр в отдельном окне '
                                        . Icon::show('external-link-alt') . ')',
                                        ['/jk/order/' . $model->id], ['target' => '_blank']),
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
                    <?php
                    // История движения заявки
                    $orderStageSearchModel = new OrderStageSearch();
                    $stages = $orderStageSearchModel->search(['OrderStageSearch' => ['order_id' => $model->id]]);
                    echo GridView::widget([
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
            <?= Html::submitButton(Yii::t('app', Icon::show('check') . 'Одобрено выделение МП'),
                ['class' => 'btn btn-success', 'name' => 'status_code', 'value' => 'COMMISSION_YES']) ?>
            <?= Html::submitButton(Yii::t('app', Icon::show('pause') . 'Резерв'),
                ['class' => 'btn btn-warning', 'name' => 'status_code', 'value' => 'RESERVE']) ?>
            <?= Html::submitButton(Yii::t('app', Icon::show('stop') . 'Отказано в выделении МП'),
                ['class' => 'btn btn-danger', 'name' => 'status_code', 'value' => 'COMMISSION_NO']) ?>
        </div>

    </div>
<?php ActiveForm::end(); ?>