<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Doc */


$this->title = $this->context->icon . ' ' . $model->title;
$this->params['breadcrumbs'][] = $this->context->parent;
$this->params['breadcrumbs'][] = ['label' => $this->context->icon . ' ' . Module::t('module', 'Docs'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title ?></h3>
            </div>

            <div class="card-body">

                <p>
                    <?= Html::a(Icon::show('edit') . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Icon::show('trash') . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
                        'createdUserLink:html',
                        'updated_at:datetime',
                        'updatedUserLink:html',
                        'deleted_at:datetime',
                        'deletedUserLink:html',
                        'title',
                        'description:ntext',
                        'filePathLink:html',
                        'weight',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>