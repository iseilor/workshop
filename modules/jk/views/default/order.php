<?php

$this->title = '<i class="fas fa-calculator nav-icon"></i>'." Заявка";
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-calculator nav-icon"></i> Заявка
                </h3>
            </div>
            <div class="card-body">
                <p>Для того, чтобы система могла подобрать для вас оптимальный вариант
                    материальной помощи, вам необходимо ответить на вопрос:</p>
                <div class="callout callout-info">
                    <h1>У вас есть уже кредит в банке?</h1>
                    <a class="btn btn-info btn-lg btn-a" href="<?= Url::to
                    (['/jk/percent/create']); ?>">Да, есть кредит</a>
                    <a class="btn btn-info btn-lg btn-a" href="<?= Url::to(['/jk/zaim/create']);
                    ?>">Нет кредита</a>
                </div>
            </div>
        </div>
    </div>
</div>