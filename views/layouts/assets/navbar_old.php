<?php

use yii\helpers\Url;

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i
                        class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?=Url::home()?>" class="nav-link">Главная</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?=Url::home()?>" class="nav-link">О проекте</a>
        </li>
    </ul>

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

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="<?=Yii::$app->homeUrl?>img/user1-128x128.jpg" alt="User Avatar"
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
                        <img src="<?=Yii::$app->homeUrl?>img/user8-128x128.jpg" alt="User Avatar"
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
                        <img src="<?=Yii::$app->homeUrl?>img/user3-128x128.jpg" alt="User Avatar"
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
        <!-- Notifications Dropdown Menu -->
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


        <!--<li class="nav-item">
         <a class="nav-link" data-widget="control-sidebar"
            data-slide="true" href="#"><i
                 class="fas fa-th-large"></i></a>
     </li>-->

    </ul>
</nav>