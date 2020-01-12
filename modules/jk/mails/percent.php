<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
    <p>
        Уважаемый, <?=$user->username?>!<br>
        На портале <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . Url::home(); ?>">WORKSHOP</a> вы произвели расчёт суммы компенсации процентов и получили следующие результаты:
    </p>
    <ul>
        <li>Максимальный размер компенсации процентов в год, руб: <strong id="result_money"><?= number_format($model->compensation_count, 0, '', ' ');; ?></strong></li>
        <li>Максимальный срок компенсации процентов, лет: <strong id="result_year"><?= $model->compensation_years; ?></strong></li>
    </ul>

    <h1>Детализация расчёта</h1>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        //'created_at',
        //'created_by',
        //'updated_at',
        //'updated_by',
        'date_birth:date',
        [
            'attribute' => 'gender',
            'value' => ($model->gender == 1 ? 'Мужской' : 'Женский'),
        ],
        'experience',
        'family_count',
        'family_income',
        'area_total',
        'area_buy',
        'cost_total',
        'cost_user',
        'bank_credit',
        [
            'attribute' => 'loan',
            'visible' => false,
        ],
        'percent_count',
        'percent_rate',
        //'compensation_result',
        'compensation_count',
        'compensation_years',
    ],
]) ?>