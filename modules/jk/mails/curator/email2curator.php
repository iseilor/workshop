<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $curator app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $message app\modules\jk\models\Message */
?>
<p>
    <strong>Уважаемый, <?= $curator->fio ?>!</strong><br>
    На портале <?=Html::a(Yii::$app->name,Url::home(true));?>
    сотрудник <strong><?= $user->fio ?></strong> написал сообщение куратору жилищной кампании<br/>
    Вам необходимо ответь на вопрос сотрудника
</p>
<ul>
    <li><strong>Сотрудник:</strong> <?= Html::a($user->fio, Url::base(true).Url::to('/user/' . $user->id)) ?></li>
    <li><strong>Сообщение:</strong> <?= $message->message ?></li>
</ul>
<p>
    <?= Html::a('Ответить на сообщение', Url::base(true).Url::to(['/jk/message/','user'=>$user->id])) ?>
</p>