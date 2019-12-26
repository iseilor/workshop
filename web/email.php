<?php

echo strtotime(date('d.m.Y'));
echo strtotime('1988-03-04');

if (mail("obedkinav@ya.ru", "заголовок", "текст")) {
echo 'Отправлено';
}
else {
echo 'Не отправлено';

}