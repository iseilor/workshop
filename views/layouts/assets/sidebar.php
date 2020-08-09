<?php


use app\components\menu\MenuActive;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link" title='<?= Yii::$app->name; ?>'>
        <img src="<?= Yii::$app->homeUrl ?>logo/logo.png" alt='<?= Yii::$app->name; ?>' title='<?= Yii::$app->name; ?>'
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Ростелеком</span>
    </a>

    <div class="sidebar">

        <!-- Если пользователь авторизован, то показываем его фото и ссылку на профиль-->
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">

                    <?php
                    $userPhoto = Yii::$app->user->identity->photo;
                    $userPhotoPath = Yii::$app->homeUrl . Yii::$app->params['module']['user']['photo']['path'] . $userPhoto;
                    ?>
                    <?= Html::img($userPhotoPath, ['title' => Yii::$app->user->identity->username, 'class' => 'img-circle elevation-2']) ?>
                </div>
                <div class="info">
                    <?= Html::a(Yii::$app->user->identity->surname, Yii::$app->homeUrl . 'user/profile', ['title' => Yii::$app->user->identity->username]); ?>
                </div>
            </div>
        <?php endif ?>

        <nav class="mt-2">
            <?php echo MenuActive::widget(
                [
                    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column nav-child-indent', 'role' => 'menu', 'data' => ['widget' => 'treeview', 'accordion' => 'false']],
                    'itemOptions' => ['class' => 'nav-item has-treeview'],
                    'linkTemplate' => '<a href="{url}" class="nav-link {activeClass}">{label}</a>',
                    'encodeLabels' => false,
                    'submenuTemplate' => "<ul class='nav nav-treeview'>{items}</ul>",
                    'activateParents' => true,
                    'activateItems' => true,
                    'activeCssClass' => 'active menu-open',
                    'items' => [
                        ['label' => '<i class="nav-icon fas fa-tachometer-alt"></i> <p>Главная</p>', 'url' => ['/main/default/index']],
                        ['label' => Icon::show(Yii::$app->params['module']['news']['iconClass'], ['class' => 'nav-icon']) . ' <p>Новости</p>', 'url' => ['/news/default/index']],
                        [
                            'label' => Icon::show('home', ['class' => 'nav-icon'])
                                . Html::tag('p', \app\modules\jk\Module::t('module', 'jk')
                                    . Icon::show('angle-left', ['class' => 'right'])),
                            'url' => ['#'],
                            'items' => [
                                [
                                    'label' => Icon::show('calculator', ['class' => 'nav-icon'])
                                        . Html::tag('p', \app\modules\jk\Module::t('calculator', 'Calculator')),
                                    'url' => ['/jk/default/calc'],
                                ],
                                ['label' => '<i class="fas fa-ruble-sign nav-icon"></i> <p>Подать заявку</p>', 'url' => ['/jk/order/create']],
                                ['label' => '<i class="fas fa-file-word nav-icon"></i> <p>Документы</p>', 'url' => ['/jk/doc/index']],
                                ['label' => '<i class="fas fa-question nav-icon"></i> <p>Частые вопросы</p>', 'url' => ['/jk/faq/index']],
                                ['label' => '<i class="fas fa-user nav-icon"></i> <p>Написать куратору</p>', 'url' => ['/jk/curator/index']],
                            ],
                        ],
                        /*[
                            'label' => Icon::show('heartbeat', ['class' => 'nav-icon']) . ' <p>Пульсар  <i class="right fas fa-angle-left"></i></p>',
                            'url' => ['#'],
                            'items' => [
                                ['label' => Icon::show('plus', ['class' => 'nav-icon']) . ' <p>Добавить</p>', 'url' => ['/pulsar/pulsar/create']],
                                ['label' => Icon::show('chart-bar', ['class' => 'nav-icon']) . ' <p>Статистика</p>', 'url' => ['/pulsar/default/index']],
                                ['label' => Icon::show('table', ['class' => 'nav-icon']) . ' <p>Таблица</p>', 'url' => ['/pulsar/default/table']],
                            ],
                        ],
                        ['label' => Icon::show('heartbeat',['class'=>'nav-icon']) .' <p>Страхование</p>', 'url' => ['/404']],
                        ['label' => Icon::show('plane',['class'=>'nav-icon']) .' <p>Путёвки</p>', 'url' => ['/404']],
                        ['label' => Icon::show('hands-helping',['class'=>'nav-icon']) .' <p>Пенсия</p>', 'url' => ['/404']],
                        ['label' => Icon::show('file-alt',['class'=>'nav-icon']) .' <p>Отчёты</p>', 'url' => ['/404']],
                        ['label' => Icon::show('file-alt',['class'=>'nav-icon']) .' <p>KPI</p>', 'url' => ['/404']],
                        ['label' => Icon::show(Yii::$app->params['module']['ns']['iconClass'],['class'=>'nav-icon']) .' <p>Аварии</p>', 'url' => ['/404']],
                        ['label' => Icon::show('comments',['class'=>'nav-icon']) .' <p>Чат</p>', 'url' => ['/chat/default/index']],
                        [
                            'label' => '<i class="nav-icon fas fa-tachometer-alt"></i> <p>Админка <i class="right fas fa-angle-left"></i></p>',
                            'url' => ['/admin/default/index'],
                            'items' => [

                                ['label' => Yii::$app->params['module']['user']['icon2'] . ' <p>Пользователи</p>', 'url' => ['/admin/user']],
                                ['label' => Yii::$app->params['module']['admin']['user-social']['icon'] . ' <p>Социальные категории</p>', 'url' => ['/admin/user-social/index']],
                                ['label' => Yii::$app->params['module']['admin']['ad']['icon'] . ' <p>Active Directory</p>', 'url' => ['/admin/ad/index']],
                                ['label' => Yii::$app->params['module']['jk']['min']['icon'] . ' <p>Минимумы</p>', 'url' => ['/jk/min/admin']],
                                ['label' => Yii::$app->params['module']['jk']['doc']['icon'] . ' <p>Документы</p>', 'url' => ['/jk/doc/admin']],
                                ['label' => Yii::$app->params['module']['jk']['percent']['icon'] . ' <p>Проценты</p>', 'url' => ['/jk/percent/admin']],
                                ['label' => Yii::$app->params['module']['jk']['zaim']['icon'] . ' <p>Займы</p>', 'url' => ['/jk/zaim/admin']],
                                ['label' => Yii::$app->params['module']['jk']['order']['icon'] . ' <p>Заявки</p>', 'url' => ['/jk/order/admin']],
                            ]
                        ],*/

                    ],
                ]
            ); ?>
        </nav>
    </div>
</aside>