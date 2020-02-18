<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\UserSocial */

$this->title = Yii::t('app', 'Create User Social');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-social-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
