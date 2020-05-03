<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Agreement */


$this->title = 'Согласование заявки №' . $model->order_id.' (ID: '.$model->id.')';
$this->params['breadcrumbs'][] = ['label' => Icon::show('home') . 'ЖК', 'url' => Url::to(['/jk'], true)];
$this->params['breadcrumbs'][] = ['label' => Icon::show('check') . 'Согласования', 'url' => Url::to(['/jk/agreement'], true)];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at:datetime',
                        [
                            'attribute' => 'createdUserLink',
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'order_id',
                            'format' => 'html',
                            'value' => Html::a($model->order_id, Url::toRoute(['/jk/order/view', 'id' => $model->order_id], true)),
                        ],
                        [
                            'attribute' => 'user',
                            'format' => 'html',
                            'value' => Html::a($model->user->fio, Url::toRoute(['/user/'. $model->user_id], true)),
                        ],
                        'receipt_at:datetime',
                        [
                            'attribute' => 'approvalBadge',
                            'format' => 'html',
                        ],
                        'approval_at:datetime',
                        'comment:ntext',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
</div>
