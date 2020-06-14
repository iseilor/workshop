<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAssetAdminLTE;
use app\widgets\Alert;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAssetAdminLTE::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?=strip_tags(Html::decode($this->title));?></title>
    <?php $this->head() ?>
    <link href="<?= Yii::$app->homeUrl ?>css/google_fonts.css" rel="stylesheet">
    <link href="<?= Yii::$app->homeUrl ?>css/ionicons.min.css" rel="stylesheet">
    <link href="<?= Yii::$app->homeUrl ?>css/style.css" rel="stylesheet">
    <link rel="icon" href="<?= Yii::$app->homeUrl ?>favicon.ico" type="image/x-icon">

</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed  layout-footer-fixed layout-fixed">
<?php $this->beginBody() ?>
<div class="wrapper">

    <?= $this->render('assets/navbar'); ?>
    <?= $this->render('assets/sidebar'); ?>

    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"><?= $this->title; ?></h1>
                    </div>
                    <div class="col-sm-6">
                        <?= Breadcrumbs::widget(
                            [
                                'tag' => 'ol',
                                'options' => [
                                    'class' => 'breadcrumb float-sm-right',
                                ],
                                'encodeLabels' => false,
                                'homeLink' => ['label' => '<i class="nav-icon fas fa-tachometer-alt"></i> Главная', 'url' => '/'],
                                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',
                                'links' => isset($this->params['breadcrumbs'])
                                    ? $this->params['breadcrumbs'] : [],
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

            <a id="chat-bot" href="#" class="btn btn-primary" data-widget="control-sidebar" data-slide="true">
                <i class="fas fa-robot"></i>
                Чат-бот Ростик
            </a>

            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <?= $this->render('assets/footer'); ?>
    <aside class="control-sidebar control-sidebar-dark chat-bot-sidebar">
        <div class="p-3 control-sidebar-content">
            <h5><?=Icon::show('robot')?>Чат-бот РОСТИК</h5>
            <hr class="mb-2">
            Укажите интересующий вас раздел<br/>
            <a class="btn btn-primary btn-xs">Главная</a>
            <a class="btn btn-primary btn-xs">Новости</a>
            <a class="btn btn-primary btn-xs">ЖК</a>
        </div>
    </aside>

</div>
<?php $this->endBody() ?>
<script src="<?= Yii::$app->homeUrl ?>js/script.js"></script>
</body>
</html>
<?php $this->endPage() ?>