<?php

/* @var $user app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */

?>
<p>
    <?= $this->render('../blocks/header', ['user' => $user]) ?><br/>
    <?= $this->render('../blocks/status', ['order' => $order]) ?><br/>
</p>
<ul>
    <?= $this->render('../blocks/order_info', ['order' => $order]) ?>
</ul>
<?= $this->render('../blocks/lk') ?>
<?= $this->render('../blocks/footer') ?>