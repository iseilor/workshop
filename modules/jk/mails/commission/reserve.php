<?php

// Письмо сотруднику о том, что его заявка переводиться в резерв

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $stage app\modules\jk\models\OrderStage */
/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
?>

<p>
    <strong>Уважаем<?= ($user->gender > 0) ? 'ый' : 'ая' ?>, <?= $user->fio ?>!</strong><br/>
    На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> ваша заявка на участие в
    Жилищной Программе переведена в статус <strong>Резерв</strong>.
    При определении даты ближайшего заседания Комиссии Вам будет сообщено дополнительно.
    Резерв сохраняется до конца текущего года.
</p>
<ul>
    <li><strong>Заявка</strong>: <?= Html::a($order->id, Url::base(true) . Url::to('/jk/order/' . $order->id)) ?>
        от <?= Yii::$app->formatter->asDate($order->created_at) ?></li>
    <li><strong>Вид материальной помощи</strong>: <?= $order->getTypeName() ?></li>
    <li><strong>Текущий статус заявки</strong>: <?= $order->status->title ?></li>
</ul>
<p>
    Также Вы можете самостоятельно следить за статусами ваших заявок в
    <?= Html::a('личном кабинете', Url::base(true).Url::to('/user/cabinet')) ?>.
</p>
<hr/>
<em>* Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него</em>