<?php
/**********************************************************
 * Письмо куратору, что ему на проверку пришла заявка
 *********************************************************/

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $curator app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
?>
<p>
    <strong>Уважаемый(ая), <?= $curator->fio ?>!</strong><br>
    На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?>
    сотрудник <?=Html::a($user->fio,Url::base(true) . Url::to('/user/' . $user->id))?>
    отправил заяку на проверку
    куратору. Вам необходимо проверить заявку данного сотрудника и как можно быстрее предоставить ему обратную связь.
</p>
<ul>
    <li><strong>ФИО сотрудника:</strong> <?=Html::a($user->fio,Url::base(true) . Url::to('/user/' . $user->id))?></li>
    <li><strong>Должность:</strong> <?=$user->position?></li>
    <li><strong>Подразделение:</strong> <?=$user->work_department_full?></li>
    <li><strong>Адрес:</strong> <?=$user->work_address?></li>
    <li><strong>Заявка:</strong> <?=Html::a($order->id,Url::base(true) . Url::to('/jk/order/' . $order->id))?></li>
    <li><strong>Дата создания заявки:</strong> <?= Yii::$app->formatter->asDatetime($order->created_at) ?></li>
    <li><strong>Тип заявки:</strong> <?= $order->getTypeName() ?></li>
</ul>
<p>
    <?= Html::a('Проверить заявку', Url::base(true) .  Url::to('/jk/order/' . $order->id.'/check')) ?>
</p>
<hr/>
<em>* Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него</em>