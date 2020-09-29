<?php
/****************************************************************
 * Заявка переведена в статус "Согласовкание руководителями"
 * Письмо сотруднику
 *****************************************************************/
/* @var $user app\modules\user\models\User */
/* @var $manager app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */
/* @var $agreement app\modules\jk\models\Agreement */

use yii\helpers\Html;
use yii\helpers\Url;
?>
    <p>
        <?= $this->render('../blocks/header', ['user' => $manager]) ?><br/>
        На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> к Вам поступила заявка на согласование участия работника в
        <strong>Жилищной Программе</strong>. Для этого необходимо пройти по
        <?= Html::a('ссылке', Url::base(true).Url::to('/jk/agreement/'.$agreement->id.'/check')) ?>.
        Срок согласования заявки - 3 рабочих дня.
    </p>
    <p>
        Если Вы подтвердждаете, что в ближайшее время работник не планиуется к сокращению/переводу в другой филиал и вы ходотайствуете о выделении ему
        долгосрочной материальной помощи, то необходимо нажать на кнопку <strong>Согласовать</strong>.
        В противном случае нажимается кнопка <strong>Не согласовать</strong>. При
        наличии комментариев Вы можете их оставить в поле <strong>Комментарий</strong>.
    </p>
    <ul>
        <?= $this->render('../blocks/user_info', ['user' => $user]) ?>
        <?= $this->render('../blocks/order_info', ['order' => $order]) ?>
    </ul>
<?= $this->render('../blocks/footer') ?>