<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetAdminLTE;

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
            <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>

    </div>
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <?= $this->render('assets/footer'); ?>
</div>
<?php $this->endBody() ?>
<script src="<?= Yii::$app->homeUrl ?>js/script.js"></script>
</body>
</html>
<?php $this->endPage() ?>