<?php

use app\modules\main\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <?php
    echo Menu::widget([
        'encodeLabels' => false,
        'options' => ['class' => 'navbar-nav'],
        'itemOptions' => ['class' => 'nav-item d-none d-sm-inline-block'],
        'linkTemplate' => '<a href="{url}" class="nav-link">{label}</a>',
        'items' => [
            ['label' => '<i class="fas fa-bars"></i>', 'url' => '#', 'options' => ['class' => 'nav-item'], 'template' => '<a href="{url}" class="nav-link" data-widget="pushmenu">{label}</a>'],
            ['label' => Icon::show('tachometer-alt') . Module::t('module', 'Home'), 'url' => ['/main/default/index']],
            ['label' => Icon::show('users') . Module::t('module', 'Teams'), 'url' => ['/main/team/index']],
            ['label' => Icon::show('info') . Module::t('module', 'About project'), 'url' => ['/main/default/about']],
            [
                'label' => Icon::show('confluence', ['framework' => Icon::FAB]) . 'Confluence',
                'url' => Url::to('https://confluence.rt.ru/display/WSHOP'),
                'template' => '<a href="{url}" class="nav-link" target="_blank" title="Проект в Confluence">{label}</a>'
            ],
            ['label' => Icon::show('envelope') . Module::t('module', 'Feedback'), 'url' => ['/main/default/feedback']],
        ],
    ]);
    ?>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search"
                   placeholder="Поиск" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-heart"></i>
                <span class="badge badge-info navbar-badge">1</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Пульсар
                                <span class="float-right text-sm text-danger"><i
                                            class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Не забудьте заполнить сегодня пульсар</p>
                            <p class="text-sm text-muted"><i
                                        class="far fa-clock mr-1"></i> 1
                                час назад</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?= Yii::$app->homeUrl ?>img/user1-128x128.jpg"
                             alt="User Avatar"
                             class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Алексей Воронин
                                <span class="float-right text-sm text-danger"><i
                                            class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Перезвони мне
                                пожалуйста...</p>
                            <p class="text-sm text-muted"><i
                                        class="far fa-clock mr-1"></i> 4
                                часа назад</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?= Yii::$app->homeUrl ?>img/user8-128x128.jpg"
                             alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Сергей Гузин
                                <span class="float-right text-sm text-muted"><i
                                            class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Пошлите на обед</p>
                            <p class="text-sm text-muted"><i
                                        class="far fa-clock mr-1"></i> 4
                                часа назад</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?= Yii::$app->homeUrl ?>img/user3-128x128.jpg"
                             alt="User Avatar"
                             class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Лада Горшкова
                                <span class="float-right text-sm text-warning"><i
                                            class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Встреча перенесена на
                                13:00</p>
                            <p class="text-sm text-muted"><i
                                        class="far fa-clock mr-1"></i> 4
                                часа назад</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Смотреть
                    все сообщения</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Уведомлений</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 сообщения
                    <span class="float-right text-muted text-sm">3 минуты назад</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 коллег
                    <span class="float-right text-muted text-sm">12 часов назад</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 отчёта
                    <span class="float-right text-muted text-sm">2 дня назад</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Смотреть
                    все
                    уведомления</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <?php

                if (Yii::$app->user->isGuest) {
                    echo Html::a(
                        '<i class="fas fa-sign-in-alt"></i> Войти',
                        Url::home() . 'login',
                        ['class' => 'dropdown-item']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-user-plus"></i> Регистрация',
                        Url::home() . 'signup',
                        ['class' => 'dropdown-item']
                    );
                } else {
                    echo Html::a(
                        '<i class="fas fa-briefcase"></i> Мой кабинет',
                        Url::home() . 'user/cabinet',
                        ['class' => 'dropdown-item']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-user-circle"></i> Мой профиль',
                        Url::home() . 'user/profile',
                        ['class' => 'dropdown-item']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        Icon::show('id-card') . 'Моя карточка',
                        Url::to('/user/' . Yii::$app->user->identity->getId(), true),
                        ['class' => 'dropdown-item']
                    );

                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        Icon::show('baby') . 'Мои дети',
                        Url::home() . 'user/child',
                        ['class' => 'dropdown-item']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-user-shield"></i> Админка',
                        Url::home() . 'admin',
                        ['class' => 'dropdown-item']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-sign-out-alt"></i> Выйти',
                        Url::home() . 'logout',
                        ['class' => 'dropdown-item', 'data-method' => 'post']
                    );
                } ?>

            </div>
        </li>
    </ul>

    <?php /*echo Nav::widget([
        'options' => ['class' => 'navbar-nav ml-auto'],
        'activateParents' => true,
        'items' => array_filter([

            ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
            ['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
                false,
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
                false,
            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
                    ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                    ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
                ]] :
                false,
            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_PROFILE'), 'items' => [
                    ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
                    ['label' => Yii::t('app', 'NAV_LOGOUT'),
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post']]
                ]] :
                false,
        ]),
    ]);*/ ?>
</nav>