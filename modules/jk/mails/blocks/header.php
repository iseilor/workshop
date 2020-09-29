<?php
/* @var $user app\modules\user\models\User */
?>
<strong>Уважаем<?= ($user->gender > 0) ? 'ый' : 'ая' ?>, <?= $user->fio ?>!</strong>