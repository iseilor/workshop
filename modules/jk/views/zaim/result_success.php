<?php

use yii\helpers\Url;

/* @var $maxMoney INT  максимальный размер займа*/
/* @var $maxYears INT максимальный срок займа*/

?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Расчёт окончен</h5>
    <ul>
        <li>Максимальный размер займа, руб: <strong id="result_money"><?=number_format($maxMoney, 0, '', ' ');;?></strong></li>
        <li>Максимальный срок займа, лет: <strong id="result_years"><?=$maxYears;?></strong></li>
    </ul>
    <a id="result-send-email" class="btn bg-gradient-primary" data-url="<?=Url::home().'jk/zaim/send-email'?>"><i class="fas fa-envelope"></i> Отправить результат на почту</a>
    <a id="result-save" class="btn bg-gradient-primary"><i class="fas fa-save nav-icon"></i> Сохранить расчёт</a>
</div>