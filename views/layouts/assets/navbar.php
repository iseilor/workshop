<?php

use app\modules\jk\models\Agreement;
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
        //'submenuTemplate' => "\n<div class='dropdown-menu'>\n{items}\n</div>\n",
        'items' => [
            [
                'label' => '<i class="fas fa-bars"></i>',
                'url' => '#',
                'options' => ['class' => 'nav-item'],
                'template' => '<a href="{url}" class="nav-link" data-widget="pushmenu" title="Свернуть левый sidebar">{label}</a>',
            ],
            [
                'label' => Icon::show('tachometer-alt'),
                'url' => ['/main/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Главная">{label}</a>',
            ],
            [
                'label' => Icon::show('calendar-check'),
                'url' => ['/news/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Новости">{label}</a>',
            ],
            [
                'label' => Icon::show('bullhorn'),
                'url' => ['/news/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Мероприятия">{label}</a>',
            ],
            [
                'label' => Icon::show('home'),
                'url' => ['/jk/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Жилищная программа">{label}</a>',
            ],
            [
                'label' => Icon::show('coins'),
                'url' => ['/pp/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Пенсионная программа">{label}</a>',
            ],
            [
                'label' => Icon::show('crown'),
                'url' => ['/kr/default/index'],
                'template' => '<a href="{url}" class="nav-link " title="Высшая лига">{label}</a>',
            ],
            [
                'label' => Icon::show('star'),
                'url' => ['/st/default/index'],
                'template' => '<a href="{url}" class="nav-link" title="Star Talk">{label}</a>',
            ],
            [
                'label' => Icon::show('info'),
                'url' => ['/main/default/about'],
                'template' => '<a href="{url}" class="nav-link" title="Информация о проекте">{label}</a>',
            ],
            [
                'label' => Icon::show('envelope'),
                'url' => ['/main/default/feedback'],
                'template' => '<a href="{url}" class="nav-link" title="Обратная связь">{label}</a>',
            ],
            [
                'label' => Icon::show('vk', ['framework' => Icon::FAB]),
                'url' => ['#'],
                'options' => ['class' => 'nav-item dropdown'],
                'template' => '<a href="{url}" class="nav-link text-primary"  data-toggle="dropdown" title="Группа ВКонтакте">{label}</a>
                                <div class="dropdown-menu dropdown-social">
                                    <div class="row justify-content-md-center">
                                        <div class="col-12  text-center"><a href="#">Группа ВКонтакте "МРФ Центр"</a></div>
                                         <div class="col-6  text-center">' . Html::img('@web/img/qr/vk.png', ['title' => 'Группа ВКонтакте']) . '</div>
                                        <div class="col-6  text-center">' . Html::img('@web/img/qr/vk_qr.png', ['title' => 'Группа ВКонтакте']) . '</div>
                                    </div>
                               </div>',
            ],
            [
                'label' => Icon::show('instagram', ['framework' => Icon::FAB]),
                'url' => ['#'],
                'options' => ['class' => 'nav-item dropdown'],
                'template' => '<a href="{url}" class="nav-link text-pink"  data-toggle="dropdown" title="">{label}</a>
                                <div class="dropdown-menu dropdown-social">
                                    <div class="row justify-content-md-center">
                                        <div class="col-12  text-center"><a href="#">Инстаграм Джо-Джо</a></div>
                                         <div class="col-6 text-center">' . Html::img('@web/img/qr/inst.png', ['title' => 'Инстаграм Джо-Джо']) . '</div>
                                        <div class="col-6 text-center">' . Html::img('@web/img/qr/inst_qr.png', ['title' => 'Инстаграм Джо-Джо']) . '</div>
                                    </div>
                               </div>',
            ],
        ],
    ]);
    ?>

    <ul class="navbar-nav ml-auto">

        <?php if (!Yii::$app->user->isGuest && Agreement::orderCount() > 0): ?>
            <li class="nav-item">
                <a href="<?= Url::home() . 'user/cabinet?&tab=check'; ?>" class="nav-link" title="Согласование заявок">
                    <i class="fas fa-check"></i>
                    Согласования
                    <span class="badge badge-primary"><?= Agreement::orderCount() ?></span>
                </a>
            </li>
        <?php endif; ?>

        <li class="nav-item dropdown">
            <?php if (Yii::$app->user->isGuest): ?>
                <?php echo Html::a(
                    Icon::show('sign-in-alt') . \app\modules\user\Module::t('module', 'Login'),
                    Url::home() . 'login',
                    ['class' => 'dropdown-item']
                ); ?>
            <?php else: ?>

                <a class="nav-link" data-toggle="dropdown" href="#">
                    <?= Icon::show('user')
                    . '<span class="d-none d-lg-inline-block">' . Yii::$app->user->identity->surname . ' '
                    . Yii::$app->user->identity->initials ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <?php
                    echo Html::a(
                        '<i class="fas fa-briefcase"></i> Мой кабинет',
                        Url::home() . 'user/cabinet',
                        ['class' => 'dropdown-item', 'title' => 'Ваша рабочая область']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-user-circle"></i> Мой профиль',
                        Url::home() . 'user/profile',
                        ['class' => 'dropdown-item', 'title' => 'Личные данные вашего профиля']
                    );
                    echo '<div class="dropdown-divider"></div>';
                    //                    echo Html::a(
                    //                        Icon::show('id-card') . 'Моя карточка',
                    //                        Url::home() . 'user/' . Yii::$app->user->identity->getId(),
                    //                        ['class' => 'dropdown-item', 'title' => 'Публичные данные вашего профиля']
                    //                    );
                    echo '<div class="dropdown-divider"></div>';
                    echo Html::a(
                        '<i class="fas fa-sign-out-alt"></i> Выйти',
                        Url::home() . 'logout',
                        ['class' => 'dropdown-item', 'data-method' => 'post']
                    );
                    ?>

                </div>
            <?php endif; ?>
        </li>
    </ul>
</nav>