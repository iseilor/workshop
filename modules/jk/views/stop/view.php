<?php

use app\modules\jk\Module;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Stop */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = ['label' => 'Админка', 'url' => ['/jk/admin']];
$this->params['breadcrumbs'][] = ['label' => Module::t('stop', 'Stops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at:datetime',
                        [
                            'label' => 'Кем создано',
                            'format' => 'raw',
                            'value' => $model->getCreatedUserLink(),
                        ],
                        'title',
                        [
                            'attribute' => 'status_id',
                            'format' => 'raw',
                            'value' => Html::a($model->status->title, Url::to(['/jk/order/status', 'id' => $model->status_id], true)),
                        ],
                        'description',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
