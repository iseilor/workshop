<?php

use app\modules\news\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\news\models\News */

$this->title = Module::t('module', 'Create News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
