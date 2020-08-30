<?php
/******************************************************************
 * Письмо сотруднику, что его заявка прошла проверку куратором
 ******************************************************************/

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $stage app\modules\jk\models\OrderStage */
/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */

?>
<p>
    <strong>Уважаемый(ая), <?= $user->fio ?>!</strong><br>
    На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?>
    ваша заявка по <strong>Жилищной Программе</strong> была переведена в статус <strong>Проверено и согласовано куратором</strong>.
    Проверить самостоятельно статус вашей заявки вы можете в
    <?=Html::a('личном кабинете',Url::home(true).'user/cabinet')?>.
</p>
<ul>
    <li><strong>Заявка:</strong> <?=Html::a($order->id,Url::base(true) . Url::to('/jk/order/' . $order->id))?></li>
    <li><strong>Новый статус:</strong> <?=$stage->status->title?></li>
    <li><strong>Дата нового статуса:</strong> <?= Yii::$app->formatter->asDatetime($stage->created_at) ?></li>
    <li><strong>Сообщение куратора:</strong> <?=$stage->comment?></li>
</ul>
<hr/>
<em>* Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него</em>