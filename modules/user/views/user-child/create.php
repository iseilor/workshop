<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\UserChild */

$this->title = Yii::t('app', 'Create User Child');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
