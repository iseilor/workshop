<?php

use yii\helpers\Html;

?>

<ul>
    <li>Начните заполнять форму и вы увидите <strong>подсказки</strong> и примеры заполнения по каждому полю</li>
    <li>Обращаем Ваше внимание, что калькулятор считает <strong>максимально возможный размер материальной помощи</strong>, без учета решения жилищной комиссии и
        утвержденного
        бюджета на
        соответствующий год
    </li>
    <li>Максимальный размер займа не может быть больше <strong>1 млн.руб.</strong> за весь период действия дополнительного соглашения
    </li>
    <li>Вы можете ознакомиться с <?= Html::a('нормативными документами', ['/jk/doc']) ?> по жилищной программе</li>
    <li>Вы можете поискать ответ на ваш вопрос среди <?= Html::a('часто задаваемых вопросов', ['/jk/faq']) ?> по жилищной программе</li>
    <li>Если вы не нашли нужную вам информацию, то вы всегда можете связаться с <?= Html::a('куратором', ['/jk/doc']) ?> по жилищной программе и получить ответы на все
        интересующие вас вопросы
    </li>
</ul>