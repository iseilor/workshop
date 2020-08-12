<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */

$this->title = Icon::show('question').Module::t('faq','Question').': '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('question').Module::t('faq', 'FAQ'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-question"></i> Вопрос</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at:datetime',
                        'createdUserLink:html',
                        'question',
                        'answer:html',
                        'weight',
                        'faq_id'
                    ],
                ]) ?>
            </div>
            <div class="card-footer">
                <?= Html::a(Icon::show('edit').Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Icon::show('trash').Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
