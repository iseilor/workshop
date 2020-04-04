<?php

use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'money_oklad:currency',
        'money_summa_year:currency',
        'money_nalog_year:currency',
        'money_month_pay:currency',
        'money_my_pay:currency',
    ]
]) ?>