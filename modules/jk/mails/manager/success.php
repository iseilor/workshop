<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $manager app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $agreement app\modules\jk\models\Agreement */
?>
<p>
    <strong>Уважаемый, <?= $user->fio ?>!</strong>
<p>
<p>
    Ваша <?= Html::a('Заявка №' . $agreement->order_id, Url::base(true) . Url::to('/jk/order/' . $agreement->order_id)) ?>
    для участия в жилищной программе была успешно согласована вашим руководителем
    <?= Html::a($manager->fio,Url::base(true).Url::to('/user/'.$manager->id)) ?>
</p>
<p>
    Далее заявка автоматически была передана для согласования вышестоящим руководителем, как только она им будет согласована,
    мы пришлём вам email-уведомление. Пожалуйста ожидайте завершения полной цепочки согласования вашими руководителями.
</p>