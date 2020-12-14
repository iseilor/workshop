<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul>
    <li><?= Html::a(Icon::show('map-marker-alt') . 'Субъекты РФ', Url::to(['/jk/min'])) ?></li>
    <li><?= Html::a(Icon::show('sitemap') . 'РФы и МРФы', Url::to(['/jk/rf'])) ?></li>
    <li><?= Html::a(Icon::show('list') . 'Статусы заявок', Url::to(['/jk/status/admin'])) ?></li>
    <li><?= Html::a(Icon::show('users') . 'Социальные группы', Url::to(['/jk/social'])) ?></li>
    <li><?= Html::a(Icon::show('undo') . 'Причины возвратов', Url::to(['/jk/stop'])) ?></li>
    <li><?= Html::a(Icon::show('list') . 'Типы займов', Url::to('/jk/zaim-type/index')) ?></li>
    <li><?= Html::a(Icon::show('list') . 'Корпоративная норма', Url::to('/jk/corp-norm')) ?></li>
    <li><?= Html::a(Icon::show('list') . 'Нормативы оказания помощи', Url::to('/jk/aid-standards')) ?></li>
</ul>