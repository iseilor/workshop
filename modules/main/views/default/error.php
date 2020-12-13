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
        К сожалению, вы оказались на странице, которая не существует, либо у вас запрещён к ней доступ.<br/>
        Если вы уверены, что такая страница существует и у вас должен быть к ней доступ, то свяжитесь пожалуйста с администраторами
        портала, и они постараются оперативно помочь вам
    </p>
</div>
