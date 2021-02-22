<?php

// Письмо сотруднику о том, что его заявка отклонена комиссией

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $stage app\modules\jk\models\OrderStage */
/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
/* @var $filial app\modules\jk\models\Rf */

$curator =  \app\modules\user\models\User::findOne(['id' => $filial->user_id]);
?>

<p>
    <strong>Уважаем<?= ($user->gender > 0) ? 'ый' : 'ая' ?>, <?= $user->fio ?>!</strong><br/>
    На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> Ваша заявка на участие в Жилищной Программе рассмотрена,
    а также заявления других работников, поступивших в рамках заявочной компании.
    С учетом приоритетности предоставления помощи и иных, заслуживающих внимания обстоятельств,
    подтвержденных предоставленными документами, Жилищной комиссией принято решение об оказании помощи в
    улучшении жилищных условий в пользу других работников.
    Также сообщаем, что Вы можете подать документы на предоставление помощи в улучшении жилищных условий на следующий
    2022 год до 28.02.2022
</p>
<ul>
    <li><strong>Заявка</strong>: <?= Html::a($order->id, Url::base(true) . Url::to('/jk/order/' . $order->id)) ?>
        от <?= Yii::$app->formatter->asDate($order->created_at) ?></li>
    <li><strong>Вид материальной помощи</strong>: <?= $order->getTypeName() ?></li>
    <li><strong>Текущий статус заявки</strong>: <?= $order->status->title ?></li>
</ul>
<p>
    К сожалению, дальнейшая работа по заявке не возможна. Если у вас остались вопросы, то вы можете связаться с куратором:
</p>
<ul>
    <li><strong>ФИО куратора</strong>: <?=$curator->fio?></li>
    <li><strong>Телефон куратора</strong>: <?=$filial->phone?></li>
    <li><strong>Email куратора</strong>: <?=$filial->email?></li>
</ul>
<hr/>
<em>* Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него</em>