<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=Yii::$app->homeUrl?>" class="brand-link">
        <img src="<?=Yii::$app->homeUrl?>img/rt_logo.jpg" alt="Ростелеком"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Workshop-2019</span>
    </a>

    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
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
    ]);?>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=Yii::$app->homeUrl?>img/user2-160x160.jpg"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::home() ?>" class="d-block">
                    <?php
                    if (Yii::$app->user->isGuest) {
                        echo Html::a('Войти','/login');
                        echo ' / ';
                        echo Html::a('Рег','signup');
                    } else {


                        echo Html::beginForm(['/site/logout'], 'post');
                        echo Html::submitButton(
                            'Выйти (' . Yii::$app->user->identity->username . ')'
                        );
                        echo Html::endForm();
                    }
                    ?>
                </a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= Url::home() ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Главная
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview menu-open">
                    <a href="/zhp" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Жилищная политика
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?=Url::to(['/jk/percent/create']);?>" class="nav-link">
                                <i class="fas fa-calculator nav-icon"></i>
                                <p>Калькулятор процентов</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?=Url::to(['/jk/percent/create']);?>" class="nav-link">
                                <i class="fas fa-calculator nav-icon"></i>
                                <p>Калькулятор займа</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-heartbeat"></i>
                        <p>
                            ДМС
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-plane"></i>
                        <p>
                            Путёвки
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Отчёты
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>