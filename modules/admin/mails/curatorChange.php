<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $curatorNew app\modules\user\models\User */
/* @var $curatorOld app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $filialName string*/
?>
<p>
    На портале <?=Html::a(Yii::$app->name,Url::home(true));?> произошла смена куратора
    по жилищной программе
</p>
<ul>
    <li><strong>Дата и время:</strong> <?=date('d.m.Y H:i:s')?></li>
    <li><strong>Филиал:</strong> <?= $filialName ?></li>
    <li><strong>Старый куратор:</strong> <?= Html::a($curatorOld->fio, Url::base(true).Url::to('/user/' . $curatorOld->id)) ?></li>
    <li><strong>Новый куратор:</strong> <?= Html::a($curatorNew->fio, Url::base(true).Url::to('/user/' . $curatorNew->id)) ?></li>
    <li><strong>Замену произвёл:</strong> <?= Html::a($user->fio, Url::base(true).Url::to('/user/' . $user->id)) ?></li>
</ul>