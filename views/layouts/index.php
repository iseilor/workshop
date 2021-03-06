<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\assets\AppAssetAdminLTE;
use app\modules\jk\models\Agreement;
use app\widgets\Alert;
use kartik\icons\Icon;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
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
        <title><?= strip_tags(Html::decode($this->title)); ?></title>
        <?php $this->head() ?>
        <link href="<?= Yii::$app->homeUrl ?>css/google_fonts.css" rel="stylesheet">
        <link href="<?= Yii::$app->homeUrl ?>css/ionicons.min.css" rel="stylesheet">
        <link href="<?= Yii::$app->homeUrl ?>css/style.css" rel="stylesheet">
        <link rel="icon" href="<?= Yii::$app->homeUrl ?>favicon.ico" type="image/x-icon">

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
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
                                    'homeLink' => ['label' => '<i class="nav-icon fas fa-tachometer-alt"></i> ??????????????', 'url' => '/'],
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

                    <!-- ???????????????????????? ?????? ???????????????? ?????????????????? -->
					
                    <?php if (!Yii::$app->user->isGuest && Agreement::orderCount()>0): ?>
                        <div class="alert alert-primary alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <h5><i class="icon fas fa-check"></i> ???????????????????????? ???? ???????????????? ??????????????????!</h5>
                            ??????-???? ???????????? ??????????????????????, ?????????????????? ???????????? ????????????????????????: <?=Agreement::orderCount()?>????.
                            <a href="<?=Url::home() . 'user/cabinet?&tab=check';?>" title="???????????????????????? ????????????">?????????????? ?? ????????????????????????</a>

                        </div>
                    <?php endif; ?>

                    <?php if (strpos($_SERVER["HTTP_USER_AGENT"], "MSIE") !== false
                    || strpos($_SERVER["HTTP_USER_AGENT"], "Trident") !== false
                    ):?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                            <h5><i class="icon fas fa-ban"></i> ????????????????!</h5>
                            ?????? ???????????????????? ???????????? ?????????????? ?????????????????????? ???????????????????? ???????????? ??????????????, ????????????????:
                            <a href="https://www.google.com/intl/ru_ru/chrome/" target="_blank">Google Chrome</a> ??????
                            <a href="https://www.mozilla.org/ru/firefox/new/" target="_blank">Mozilla Firefox</a>
                        </div>
                    <?php else:?>
                        <?= $content ?>
                    <?php endif; ?>

                </div>

                <div class="right-bottom-side-bar">
                    <a id="jk-curator-contacts" href="#" class="btn btn-primary">
                        <i class="fas fa-id-card" ></i>
                        <span id="jk-curator-contacts-text">?????????????? ???????????????????? ???? ????????????????</span>
                    </a>

                    <a id="chat-bot" href="#" class="btn btn-primary" data-widget="control-sidebar" data-slide="true" style="display: none;">
                        <i class="fas fa-robot"></i>
                        ??????-?????? ????????????
                    </a>

                   <!--  <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
                        <i class="fas fa-chevron-up"></i>
                    </a> -->

                 <!-- <a id="back-to-top" href="#" class="btn btn-primary" role="button" aria-label="Scroll to top">
                        <i class="fas fa-chevron-up"></i>
                    </a> -->
                </div>


            </div>
        </div>
        <?= $this->render('assets/footer'); ?>
        <?= $this->render('assets/aside'); ?>
        <?php echo $this->render('@app/modules/bot/views/bot/modal');?>
    </div>


    <div id="jk-curator-info" class="col-md-3 jk-curator-info-card" style="display: none;" >
        <?php echo $this->render('@app/modules/jk/views/curator/info');?>
    </div>

    <?php $this->endBody() ?>
    <script src="<?= Yii::$app->homeUrl ?>js/script.js"></script>
    </body>
    </html>
<?php $this->endPage() ?>