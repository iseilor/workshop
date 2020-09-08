<?php


use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul>
    <li><?= Html::a(Icon::show('cubes') . 'Блоки', Url::to(['/kr/block/admin'])) ?></li>
    <li><?= Html::a(Icon::show('user-graduate') . 'Тренеры и кураторы', Url::to(['/kr/curator/admin'])) ?></li>
    <li><?= Html::a(Icon::show('users') . 'Участники программы', Url::to(['/kr/user/admin'])) ?></li>
</ul>