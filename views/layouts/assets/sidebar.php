<?php


use app\components\menu\MenuActive;
use yii\helpers\Html;
use yii\helpers\Url;


?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= Yii::$app->homeUrl ?>" class="brand-link">
        <img src="<?= Yii::$app->homeUrl ?>img/rt_logo.jpg" alt="<?= Yii::$app->id; ?>"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->id; ?></span>
    </a>

    <div class="sidebar">

        <!-- Если пользователь авторизован, то показываем его фото и ссылку на профиль-->
        <?php if (!Yii::$app->user->isGuest): ?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?= Yii::$app->homeUrl ?>img/user2-160x160.jpg"
                         class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="<?= Url::home() ?>" class="d-block">
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            {
                                echo Html::a(
                                    Yii::$app->user->identity->username,
                                    Url::home() . 'user/profile'
                                );
                            }
                        }
                        ?>
                    </a>
                </div>
            </div>
        <?php endif ?>

        <nav class="mt-2">
            <?php echo MenuActive::widget(
                [
                    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'role' => 'menu', 'data' => ['widget' => 'treeview', 'accordion' => 'false']],
                    'itemOptions' => ['class' => 'nav-item has-treeview'],
                    'linkTemplate' => '<a href="{url}" class="nav-link {activeClass}">{label}</a>',
                    'encodeLabels' => false,
                    'submenuTemplate' => "<ul class='nav nav-treeview'>{items}</ul>",
                    'activateParents' => true,
                    'activateItems' => true,
                    'activeCssClass'=>'active menu-open',
                    'items' => [
                        ['label' => '<i class="nav-icon fas fa-tachometer-alt"></i> Главная', 'url' => ['/main/default/index']],
                        [
                            'label' => '<i class="nav-icon fas fa-home"></i> <p>Жилищная компания  <i class="right fas fa-angle-left"></i></p>',
                            'url' => ['#'],
                            'items' => [
                                ['label' => '<i class="fas fa-calculator nav-icon"></i> Калькулятор процентов', 'url' => [ Url::to(['/jk/percent/create'])]],
                                ['label' => '<i class="fas fa-calculator nav-icon"></i> Калькулятор займа', 'url' => [ Url::to(['/jk/zaim/create'])]],
                                ['label' => '<i class="fas fa-ruble-sign nav-icon"></i> Заявка', 'url' => [ Url::to(['/jk/order/create'])]],
                            ]
                        ],
                    ],
                ]
            ); ?>
        </nav>
    </div>
</aside>