<?php

use app\modules\pp\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

$this->title = Icon::show('coins') . Module::t('module', 'pp');
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        <?= Html::img(Yii::$app->homeUrl . 'img/pp/0.jpg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-10">
                        <p class="lead"><strong>Уважаемые коллеги!</strong><br>
                            С 2016 года в <a href="/">«Ростелекоме»</a> действует корпоративная
                            <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a>, участниками
                            которой уже стали
                            почти 40 тысяч сотрудников. <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a> рассчитана и на
                            сотрудников, которые уже давно
                            работают
                            в компании, и на тех, кто только начал свою карьеру в <a href="/">«Ростелекоме»</a>.
                        </p>
                        <h1>Как работает программа?</h1>
                        <p class="lead">Оператором <a href="/pp/"><?= Icon::show('coins') ?> Пенсионной программы</a> <a href="/">«Ростелекома»</a>
                            является дочерний пенсионный
                            фонд <a href="/">«Альянс»</a>
                            *.</p>
                    </div>
                    <div class="col-md-2">
                        <?= Html::img(Yii::$app->homeUrl . 'img/pp/1.jpg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-md-10">
                        <p class="lead">
                            Программа работает как банковский вклад, но предлагает более выгодные условия: накопления формируются не только из
                            отчислений сотрудника, но также из вносов сопоставимого размера, которые делает компания. Вы получаете 100% доход
                            ежемесячно
                        </p>
                    </div>
                    <div class="col-md-2">
                        <?= Html::img(Yii::$app->homeUrl . 'img/pp/2.jpg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-md-10">
                        <p class="lead">
                            Дополнительные средства от компании — это мотивационный взнос, который начисляется на счет сотрудника за эффективную
                            работу по итогам года (выполнение КПЭ выше 90%)
                        </p>
                    </div>
                    <div class="col-md-2">
                        <?= Html::img(Yii::$app->homeUrl . 'img/pp/3.jpg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-md-10">
                        <p class="lead">
                            Ваши накопления работают. Ежегодно пенсионный фонд <a href="/">«Альянс»</a> начисляет инвестиционный доход. Результаты
                            инвестиционной
                            деятельности фонда за 2019 год: 9,7% — по негосударственному пенсионному обеспечению; 9,68% — по обязательному пенсионному
                            страхованию
                        </p>
                    </div>
                    <div class="col-md-2">
                        <?= Html::img(Yii::$app->homeUrl . 'img/pp/4.jpg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-md-10">
                        <p class="lead">
                            Подробнее о корпоративной <a href="/pp/"><?= Icon::show('coins') ?> Пенсионной программе</a> и о том как стать ее
                            участником, читайте на
                            <a target="_blank" href="https://www.portal.rt.ru/wps/myportal/Home/personal/pensionnaya_programa">портале</a>.
                            Если у вас возникнут вопросы, вы можете получить консультацию в Центре компетенций по
                            <a href="/pp/"><?= Icon::show('coins') ?> Пенсионной программе</a>:
                            <a href="mailto:cpp@rt.ru">cpp@rt.ru</a>.
                        </p>
                        <ul class="lead">
                            <li><?= Icon::show('user') ?>Баладурина Татьяна Александровна; <?= Icon::show('phone') ?>+7 (495)
                                855-55-32; <?= Icon::show('mobile-alt') ?>+7 (926) 818-69-98
                            </li>
                            <li><?= Icon::show('user') ?>Калашникова Екатерина Валерьевна; <?= Icon::show('phone') ?>+7 (495)
                                855-55-73; <?= Icon::show('mobile-alt') ?>+7 (926) 608-45-06
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                * В конце декабря 2019 года «Ростелеком» приобрел у April Group 44% акций дочернего пенсионного фонда «Альянс».<br>
                «Ростелеком» — контролирующий акционер фонда «Альянс» (95%).
            </div>
        </div>
    </div>
</div>