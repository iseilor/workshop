<?php

$i = 10;
if (mail("obedkinav@ya.ru", "заголовок", "текст")) {
echo 'Отправлено';
}
else {
echo 'Не отправлено';

}