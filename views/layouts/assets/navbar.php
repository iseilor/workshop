<?php
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\bootstrap\Nav;

NavBar::begin([
    'brandLabel' => 'My Company',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'main-header navbar navbar-expand navbar-white navbar-light',
    ],
]);

$menuItems = [
    ['label' => 'Contact', 'url' => ['/site/contact']],
];

if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Зарегистрироваться', 'url' => ['/site/signup']];
    $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
        . Html::beginForm(['/site/logout'], 'post')
        . Html::submitButton(
            'Выйти (' . Yii::$app->user->identity->username . ')',
            ['class' => 'btn btn-link logout']
        )
        . Html::endForm()
        . '</li>';
}

echo Nav::widget([
    'options' => ['class' => 'main-header navbar navbar-expand navbar-white navbar-light'],
    'items' => $menuItems,
]);

NavBar::end();