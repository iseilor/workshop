<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $curator app\modules\user\models\User */
/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */

?>
<p>
    <strong>Уважаемый куратор жилищной кампании, <?= $curator->fio ?></strong><br>
    На портале <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . Url::home(); ?>">WORKSHOP</a>
    пользователь <strong><?=$user->fio?></strong> перевёл новую заявку для проверки куратором.<br/>
    Вам необходимо проверить введённые пользователем данные и прикреплённые документы.
</p>
<ul>
    <li><strong>ФИО сотрудника:</strong> <?=$user->fio?></li>
    <li><strong>Должность:</strong> <?=$user->position?></li>
    <li><strong>Подразделение:</strong> <?=$user->work_department?></li>
    <li><strong>Номер заявки:</strong> <?=$order->id?></li>
</ul>
<?php
$path = 'http://' . $_SERVER['SERVER_NAME'].Url::home().'jk/order/'.$order->id.'/check';
?>
<p><?=Html::a('Проверить заявку',$path)?></p>