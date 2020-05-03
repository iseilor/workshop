<?php

use app\components\grid\LinkColumn;
use app\components\grid\SetColumn;
use app\modules\jk\models\Agreement;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $order app\modules\jk\models\Order */
/* @var $model app\modules\jk\models\Agreement */

$this->title = Icon::show('check') . Yii::t('app', 'Согласование заявки №' . $model->order_id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Согласование заявки сотрудника на участие в жилищной кампании</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <?php $form = ActiveForm::begin(); ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><?= Icon::show('file') ?>Заявка №<?= $model->order_id ?></h5>
                        <?= DetailView::widget([
                            'model' => $order,
                            'attributes' => [
                                [
                                    'attribute' => 'id',
                                    'format' => 'html',
                                    'value' => Html::a($order->id, Url::toRoute(['/jk/order/view', 'id' => $order->id], true)),
                                ],
                                'created_at:datetime',
                                'typeName',
                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <h5><?= Icon::show('user') ?>Сотрудник</h5>
                        <?= DetailView::widget([
                            'model' => $user,
                            'attributes' => [
                                [
                                    'attribute' => 'fio',
                                    'format' => 'html',
                                    'value' => Html::a($user->fio, Url::toRoute(['/user/' . $user->id], true)),
                                ],
                                'position',
                                'work_department',

                            ],
                        ]) ?>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                        <h5><?= Icon::show('list') ?>Последовательность согласования заявки №<?= $model->order_id ?></h5>
                        <?= GridView::widget([
                            'dataProvider' => $agreementDataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'class' => LinkColumn::class,
                                    'attribute' => 'id',
                                    'controller' => '/jk/agreement/view',
                                ],
                                [
                                    'class' => LinkColumn::class,
                                    'attribute' => 'user.fio',
                                    'url' => function ($data) {
                                        return Url::to(['/user/' . $data->order_id], true);
                                    },
                                ],
                                'receipt_at:datetime',
                                'approval_at:datetime',
                                [
                                    'class' => SetColumn::class,
                                    'attribute' => 'approval',
                                    'name' => 'approvalName',
                                    'filter' => Agreement::getApprovalsArray(),
                                    'cssCLasses' => [
                                        Agreement::APPROVAL_WAIT => 'warning',
                                        Agreement::APPROVAL_YES => 'success',
                                        Agreement::APPROVAL_NO => 'danger',
                                    ],
                                ],

                                'comment',
                            ],
                        ]); ?>
                    </div>
                    <div class="col-md-12">
                        <hr/>
                        <h5><?= Icon::show('check') ?>Ваше согласование заявки №<?= $model->order_id ?></h5>
                        <?php if (isset($model->approval)): ?>
                            <?php if ($model->approval != Agreement::APPROVAL_WAIT): ?>
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                        [
                                            'attribute' => 'approvalBadge',
                                            'format' => 'html',
                                        ],
                                        'receipt_at:datetime',
                                        'approval_at:datetime',
                                        'comment',
                                    ],
                                ]) ?>
                            <?php else: ?>
                                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-danger alert-dismissible">
                                Данная заявка ещё не поступила к вам на согласование
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (isset($model->approval) && $model->approval == Agreement::APPROVAL_WAIT): ?>
                <div class="card-footer">
                    <?= Html::submitButton(Icon::show('thumbs-up') . 'Согласовано', ['class' => 'btn btn-success', 'name' => 'approval', 'value' => Agreement::APPROVAL_YES]) ?>
                    <?= Html::submitButton(Icon::show('thumbs-down') . 'Не согласовано', ['class' => 'btn btn-danger', 'name' => 'approval', 'value' => Agreement::APPROVAL_NO]) ?>
                </div>
            <?php endif; ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>