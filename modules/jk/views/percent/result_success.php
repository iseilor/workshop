<?php

use yii\helpers\Url;

?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Расчёт окончен</h5>
    <ul>
        <li>Максимальный размер компенсации процентов в год, руб: <strong id="result_money"><?=number_format($maxPercentMoney, 0, '', ' ');;?></strong></li>
        <li>Максимальный срок компенсации процентов, лет: <strong id="result_years"><?=$maxPercentYears;?></strong></li>
    </ul>
    <a id="result-send-email" class="btn bg-gradient-primary" data-url="<?=Url::home().'jk/percent/send-email'?>"><i class="fas fa-envelope"></i> Отправить результат на почту</a>
    <a id="result-save" class="btn bg-gradient-primary"><i class="fas fa-save nav-icon"></i> Сохранить расчёт</a>
</div>