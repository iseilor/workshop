
<?php
/* @var $order app\modules\jk\models\Order */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<li><strong>Заявка</strong>: <?= Html::a($order->id, Url::base(true) . Url::to('/jk/order/' . $order->id)) ?>
    от <?= Yii::$app->formatter->asDate($order->created_at) ?></li>
<li><strong>Вид материальной помощи</strong>: <?= $order->getTypeName() ?></li>
<li><strong>Текущий статус заявки</strong>: <?= $order->status->title ?></li>