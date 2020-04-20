<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $manager app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $agreement app\modules\jk\models\Agreement */

$url = 'http://' . $_SERVER['SERVER_NAME'];
?>
<p>
    <strong>Уважаемый <?= $manager->fio ?>!</strong><br>
    На портале <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . Url::home(); ?>">WORKSHOP</a>
    сотрудник <strong><?= $user->fio ?></strong> подал заявку для участия в жилищной кампании.<br/>
    Вам необходимо согласовать заявку данного сотрудника
</p>
<ul>
    <li><strong>Сотрудник:</strong> <?= Html::a($user->fio, $url . Url::to('/user/' . $user->id)) ?></li>
    <li><strong>Должность:</strong> <?= $user->position ?></li>
    <li><strong>Подразделение:</strong> <?= $user->work_department ?></li>
    <li><strong>Заявка:</strong> <?= Html::a($agreement->order_id, $url . Url::to('/jk/order/' . $agreement->order_id)) ?></li>
</ul>
<p><?= Html::a('Согласовать заявку', $url.Url::to('/jk/agreement/'.$agreement->id.'/check')) ?></p>