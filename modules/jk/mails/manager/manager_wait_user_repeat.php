<?php
/****************************************************************
 * Письмо сотруднику, что было отправлено повторное напоминание руководителю
 *****************************************************************/
/* @var $user app\modules\user\models\User */
/* @var $manager app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */

use yii\helpers\Html;
use yii\helpers\Url;

?>
    <p>
        <?= $this->render('../blocks/header', ['user' => $user]) ?><br/>
        На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?>
        по вашей заявке на участие в <strong>Жилищной Программе</strong>
        было отправлено повторное напоминание руководителю, у которого в данный
        момент ваша заявка всё ещё находится на согласовании.
    </p>
    <ul>
        <?= $this->render('../blocks/order_info', ['order' => $order]) ?>
        <li><strong>ФИО текущего согласующего:</strong> <?=$manager->fio?></li>
    </ul>
<?= $this->render('../blocks/lk') ?>
<?= $this->render('../blocks/footer') ?>