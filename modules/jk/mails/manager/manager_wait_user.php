<?php
/****************************************************************
 * Заявка переведена в статус "Согласовкание руководителями"
 * Письмо сотруднику
 *****************************************************************/
/* @var $user app\modules\user\models\User */
/* @var $manager app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
?>
    <p>
        <?= $this->render('../blocks/header', ['user' => $user]) ?><br/>
        <?= $this->render('../blocks/status', ['order' => $order]) ?>
    </p>
    <ul>
        <?= $this->render('../blocks/order_info', ['order' => $order]) ?>
        <li><strong>ФИО текущего согласующего:</strong> <?=$manager->fio?></li>
    </ul>
<?= $this->render('../blocks/lk') ?>
<?= $this->render('../blocks/footer') ?>