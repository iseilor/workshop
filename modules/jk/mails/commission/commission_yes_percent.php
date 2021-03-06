<?php
/**********************************************************
 * Письмо сотруднику, что его заявка согласована комиссией
 *********************************************************/

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
/* @var $stage app\modules\jk\models\OrderStage */
?>

<p>
    <strong>Уважаем<?=($user->gender>0)?'ый':'ая'?>, <?= $user->fio ?>!</strong><br/>
    На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> по Вашей заявке на участие в Жилищной Программе принято
    положительное решение в части оказания Вам помощи на приобретение жилья в виде компенсации процентов по ипотечному кредиту в размере
    <?=$stage->field1?>% на срок <?=$stage->field2?> лет (<?=$stage->field3?>). Максимальная сумма
    выплат в целом по ДС <strong><?=$stage->field4?> руб</strong>.
    Максимальная сумма выплат в год <strong><?=$stage->field5?> руб.</strong>
</p>

<ul>
    <li>Сообщение куратора: <?=$stage->comment?></li>
    <li>Заявка: <?= Html::a($order->id, Url::base(true) . Url::to('/jk/order/' . $order->id)) ?>
        от <?= Yii::$app->formatter->asDate($order->created_at) ?></li>
    <li>Вид материальной помощи: <?= $order->getTypeName() ?></li>
    <li>Текущий статус заявки: <?= $order->status->title ?></li>
</ul>

<p>
    До заключения Дополнительного соглашения к Трудовому договору о компенсации процентов и соответственно оказании помощи Вам необходимо
    предоставить:</p>
<ul>
    <li>выписку/уведомление Управления федеральной регистрационной службы о наличии в Едином государственном реестре прав на недвижимое имущество и
        сделок
        с ним (ЕГРН) прав собственности на жилые помещения всех членов семьи (супруг/супруга, дети) и сделок с ними по всей территории РФ за последние
        5 лет (с января 2016 по н.в.), предшествующие подаче заявления (утверждена ФЗ о государственной регистрации недвижимости от 13.07.2015 №
        218-ФЗ)
    </li>
    <li>запрос на получение выписки из ЕГРП по всем членам семьи (скан-копию);</li>
    <li>актуальный график погашения кредита и процентов по кредиту (скан-копию);</li>
    <li>справка об уплаченных процентах за период январь-июнь т.г. (оригинал) (предоставляется в срок до 12.07.2021)</li>
    <li><?=$stage->comment2?></li>
</ul>
<p>Для информации:</p>
<ul>
    <li>В случае, если у Вас / супруги была изменена фамилия, то в запросе на получение ЕГРН необходимо указать все Фамилии;</li>
    <li>В случае изменения данных Вашего паспорта/ изменения состава семьи и других данных, поданных ранее в заявлении на оказание материальной помощи
        необходимо оперативно информировать куратора;
    </li>
</ul>
<p>
    Для вложения документов в заявку Вам необходимо пройти по <?= Html::a('ссылке', Url::base(true) . Url::to('/jk/order/' . $order->id)) ?>
    и нажать на кнопку <strong>"Отправить заявку"</strong>.</p>
<hr/>
<em>* Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него</em>