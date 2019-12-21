<?php

if (mail("obedkin@gmail.com", "заголовок", "текст")) {
echo 'Отправлено';
}
else {
echo 'Не отправлено';
}