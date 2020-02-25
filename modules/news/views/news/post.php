<?php

use app\modules\news\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::$app->params['module']['news']['icon'] . ' ' . Module::t('module', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $model->title ?></h3>
            </div>
            <div class="card-body">
                <?= $model->text ?>
            </div>
            <div class="card-footer">
                <?= Html::a('<i class="far fa-calendar-alt"></i> ' . Yii::$app->formatter->format($model->created_at, 'datetime'), '#', ['title' => 'Дата публикации']); ?> |
                <?= Html::a('<i class="fas fa-eye"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во просмотров']); ?> |
                <?= Html::a('<i class="fas fa-comments"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во комментариев']); ?> |
                <?= Html::a('<i class="fas fa-heart"></i> ' . rand(0, 10), '#', ['title' => 'Кол-во лайков']); ?>
            </div>
        </div>
    </div>
</div>