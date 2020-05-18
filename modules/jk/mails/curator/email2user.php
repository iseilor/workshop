<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $curator app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $message app\modules\jk\models\Message */
?>
<p>
    <strong>Уважаемый, <?= $user->fio ?>!</strong><br>
    На портале <?=Html::a(Yii::$app->name,Url::home(true));?>
    куратор <strong><?= $curator->fio ?></strong> написал ответ на ваше сообщение<br/>
    Вы можете вернуться на портал и просмотреть всю историю переписки
</p>
<ul>
    <li><strong>Сообщение:</strong> <?= $message->message ?></li>
</ul>
<p>
    <?= Html::a('Просмотреть ответ куратора', Url::base(true).Url::to(['jk/curator/'])) ?>
</p>

<p>
    * Данное сообщение сформировано автоматически и не требует ответа
</p>