<?php
/* @var $order app\modules\jk\models\Order */

use yii\helpers\Html;
use yii\helpers\Url;

?>
На портале <?= Html::a(Yii::$app->name, Url::home(true)); ?> Ваша заявка на участие в <strong>Жилищной Программе</strong>
переведена в статус <strong><?= $order->status->title ?></strong>.