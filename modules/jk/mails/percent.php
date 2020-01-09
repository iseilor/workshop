<?php

use yii\helpers\Url;
use yii\widgets\DetailView;

?>
    <p>
        Уважаемый, <?=$user->username?>!<br>
        На портале <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . Url::home(); ?>">WORKSHOP</a> вы произвели расчёт суммы компенсации процентов и получили следующие результаты:
    </p>
    <ul>
        <li>Максимальный размер компенсации процентов в год, руб: <strong id="result_money"><?= number_format($percent->compensation_count, 0, '', ' ');; ?></strong></li>
        <li>Максимальный срок компенсации процентов, лет: <strong id="result_year"><?= $percent->compensation_years; ?></strong></li>
    </ul>

    <h1>Детализация расчёта</h1>
<?= DetailView::widget(
    [
        'model' => $percent,
        'template' => '<tr><td>{label}</td><td>{value}</td></tr>',
        'attributes' => [
            'id',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'date_birth',
            'gender',
            'experience',
            'family_count',
            'family_income',
            'area_total',
            'area_buy',
            'cost_total',
            'cost_user',
            'bank_credit',
            'loan',
            'percent_count',
            'percent_rate',
            'compensation_result',
            'compensation_count',
            'compensation_years',
        ],
    ]
) ?>