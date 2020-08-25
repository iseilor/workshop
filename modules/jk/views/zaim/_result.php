<?php
/* @var $model app\modules\jk\models\Zaim */

use kartik\icons\Icon; ?>

<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h3><?=Icon::show('calculator')?> Результат расчёта</h3>
    <ul>
        <li>Максимальный размер займа, руб: <strong><?= Yii::$app->formatter->asInteger($model->compensation_count); ?></strong> руб</li>
        <li>Максимальный срок займа: <strong><?= $model->compensation_years ?></strong> лет</li>
        <li>Ежемесячный платёж: <strong><?= Yii::$app->formatter->asInteger($model->compensation_count/(12*$model->compensation_years));?></strong> руб</li>
    </ul>
    <hr/>
    <small>
        * Полученная сумма и срок возврата материальной помощи являются предварительными, и могут быть скорректированы по решению жилищной комиссии<br/>
        * Результаты расчёта вам также будут доступны в личном кабинете
    </small>
</div>