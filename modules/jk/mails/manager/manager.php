<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $manager app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $agreement app\modules\jk\models\Agreement */
?>
<p>
    <strong>Уважаемый, <?= $manager->fio ?>!</strong><br>
    На портале <?=Html::a(Yii::$app->name,Url::home(true));?>
    сотрудник <strong><?= $user->fio ?></strong> подал заявку для участия в жилищной кампании.<br/>
    Вам необходимо согласовать заявку данного сотрудника
</p>
<ul>
    <li><strong>Сотрудник:</strong> <?= Html::a($user->fio, Url::base(true).Url::to('/user/' . $user->id)) ?></li>
    <li><strong>Должность:</strong> <?= $user->position ?></li>
    <li><strong>Подразделение:</strong> <?= $user->work_department ?></li>
    <li><strong>Заявка:</strong> <?= Html::a($agreement->order_id,  Url::base(true).Url::to('/jk/order/' . $agreement->order_id)) ?></li>
</ul>
<p>
    <?= Html::a('Согласовать заявку', Url::base(true).Url::to('/jk/agreement/'.$agreement->id.'/check')) ?>
</p>
<p>
    Другие заявки, ожидающие вашего согласования, вы можете посмотреть на портале в личном кабинете руководителя
    <?= Html::a('Личный кабинет', Url::base(true).Url::to('/user/cabinet/')) ?>
</p>