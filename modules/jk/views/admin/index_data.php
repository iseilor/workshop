<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<ul>
    <li><?= Html::a(Icon::show('percent') . 'Расчёты процентов', Url::to(['/jk/percent/'])) ?></li>
    <li><?= Html::a(Icon::show('wallet') . 'Расчёты займов', Url::to(['/jk/zaim/'])) ?></li>
    <li><?= Html::a(Icon::show('ruble-sign') . 'Заявки ', Url::to(['/jk/order/'])) ?></li>
    <li><?= Html::a(Icon::show('comments') . 'Сообщения куратору ', Url::to(['/jk/message'])) ?></li>
    <li><?= Html::a(Icon::show('file-word') . 'Документы', Url::to(['/jk/doc/admin'])) ?></li>
    <li><?= Html::a(Icon::show('question') . Module::t('faq', 'FAQ'), Url::to(['/jk/faq/admin'])) ?></li>
</ul>