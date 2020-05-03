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
    для участия в жилищной кампании НЕ была согласована вашим руководителем
    <?= Html::a($manager->fio,Url::base(true).Url::to('/user/'.$manager->id)) ?>
</p>
<p>
    К сожалению, вы не можете участвовать в жилищной кампании, без согласования заявки с одним из ваших руководителей.
</p>