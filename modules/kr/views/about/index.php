<?php

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;


$this->title = Icon::show('info') . Module::t('module', 'About');
$this->params['breadcrumbs'][] = [ 'label' => Icon::show(Module::getIcon()) . Module::t('module', 'kr'), 'url' => ['/kr']];
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <?= Html::img(Yii::$app->homeUrl . 'img/kr/about/kr.svg', ['class' => 'img-fluid pad']); ?>
                    </div>
                    <div class="col-8">
                        <p class="lead"><strong>Уважаемые коллеги!</strong><br>
                            С 2016 года в <a href="/">«Ростелекоме»</a> действует корпоративная
                            <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a>, участниками
                            которой уже стали
                            почти 40 тысяч сотрудников. <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a> рассчитана и на
                            сотрудников, которые уже давно
                            работают
                            в компании, и на тех, кто только начал свою карьеру в <a href="/">«Ростелекоме»</a>.
                        </p>
                        <p class="lead"><strong>Уважаемые коллеги!</strong><br>
                            С 2016 года в <a href="/">«Ростелекоме»</a> действует корпоративная
                            <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a>, участниками
                            которой уже стали
                            почти 40 тысяч сотрудников. <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a> рассчитана и на
                            сотрудников, которые уже давно
                            работают
                            в компании, и на тех, кто только начал свою карьеру в <a href="/">«Ростелекоме»</a>.
                        </p>
                        <p class="lead"><strong>Уважаемые коллеги!</strong><br>
                            С 2016 года в <a href="/">«Ростелекоме»</a> действует корпоративная
                            <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a>, участниками
                            которой уже стали
                            почти 40 тысяч сотрудников. <a href="/pp/"><?= Icon::show('coins') ?> Пенсионная программа</a> рассчитана и на
                            сотрудников, которые уже давно
                            работают
                            в компании, и на тех, кто только начал свою карьеру в <a href="/">«Ростелекоме»</a>.
                        </p>

                    </div>
                </div>
            </div>
            <div class="card-footer text-muted">
                * Текст текст текст
            </div>
        </div>
    </div>
</div>