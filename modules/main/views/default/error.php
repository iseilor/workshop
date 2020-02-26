<?php

/* @var $this yii\web\View */

/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <p>
        К сожалению вы оказались на странице, которая не существует
        Если вы уверены, что такая страница должна быть, но она вам недоступна, свяжитесь пожалуйста с администраторами портала и они постараются оперативно помочь вам
    </p>
</div>
