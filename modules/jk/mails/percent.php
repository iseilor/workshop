<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
    <p>
        <strong>Уважаемый, <?= $user->fio ?>!</strong><br>
        На портале <a href="<?= 'http://' . $_SERVER['SERVER_NAME'] . Url::home(); ?>">WORKSHOP</a> вы произвели расчёт суммы компенсации процентов и получили следующие результаты:
    </p>
    <ul>
        <li>Максимальный размер компенсации процентов в год, руб: <strong id="result_money"><?= number_format($model->compensation_count, 0, '', ' ');; ?></strong></li>
        <li>Максимальный срок компенсации процентов, лет: <strong id="result_year"><?= $model->compensation_years; ?></strong></li>
    </ul>
    <hr/>
    <h3>Детализация расчёта</h3>
<?= DetailView::widget(
    [
        'model' => $model,
        'template' => '<tr><td{captionOptions}>{label}</td><td{contentOptions}>{value}</td></tr>',
        'attributes' => [
            'date_birth:date',
            [
                'attribute' => 'gender',
                'value' => ($model->gender == 1 ? 'Мужской' : 'Женский'),
            ],
            'experience',
            'family_count',
            'family_income:integer',
            'area_total:decimal',
            'area_buy:decimal',
            'cost_total:integer',
            'cost_user:integer',
            'bank_credit:integer',
            [
                'attribute' => 'loan',
                'visible' => false,
            ],
            'percent_count:integer',
            'percent_rate:decimal',
            [
                'attribute' => 'compensation_count',
                'format'=>'integer',
                'contentOptions' => ['class' => 'table-success']
            ],
            [
                'attribute' => 'compensation_years',
                'contentOptions' => ['class' => 'table-success']
            ]
        ],
    ]
) ?>