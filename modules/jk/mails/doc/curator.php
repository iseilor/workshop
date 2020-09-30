<?php

/* @var $user app\modules\user\models\User */
/* @var $curator app\modules\user\models\User */
/* @var $order app\modules\jk\models\Order */

use yii\helpers\Html;
use yii\helpers\Url;

?>
    <p>
        <?= $this->render('../blocks/header', ['user' => $curator]) ?><br/>
        На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> к Вам на проверку и оформление поступила заявка по
        <strong>Жилищной Программе</strong>.
        Для этого необходимо пройти по ссылке:
        <?= Html::a('Оформление документов по заявке № ' . $order->id, Url::base(true) . Url::to('/jk/order/' . $order->id . '/doc')) ?>.
        Срок проверки заявки - 3 рабочих дня.
        Если нет вопросов по прилагаемому пакету документов, то необходимо приложить скан копию Дополнительного соглашения к Трудовому договору (для
        компенсации %) / Договора займа (для займа) нажать на кнопку <strong>Заявка выполнена</strong>.
        При наличии замечаний нажимается кнопка <strong>Вернуть для исправления</strong>.
        Все вопросы и замечания по заявке отражаются в окне <strong>Комментарий</strong>.
        В случае не соответствия заявления нормам Положения необходимо нажать кнопку <strong>Отказать в помощи</strong>
    </p>
    <ul>
        <?= $this->render('../blocks/user_info', ['user' => $user]) ?>
        <?= $this->render('../blocks/order_info', ['order' => $order]) ?>
    </ul>

<?= $this->render('../blocks/footer') ?>