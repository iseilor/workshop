<?php

/* @var $this yii\web\View */
$this->title = Yii::$app->name;

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">

    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Новости</h3>
                <p>Всегда свежая информация</p>
            </div>
            <div class="icon">
                <?=Yii::$app->params['module']['news']['icon']?>
            </div>
            <?=Html::a('Перейти <i class="fas fa-arrow-circle-right"></i>',Url::to('news'),['class'=>'small-box-footer'])?>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Отчёты</h3>
                <p>Статистика и отчёты</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="#" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>Чат</h3>
                <p>Общение сотрудников</p>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
            <a href="#" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Админка</h3>
                <p>Административная панель</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="<?= Url::to(['/admin/']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= \app\modules\jk\Module::t('module', 'JK') ?></h3>
                <p><?= \app\modules\jk\Module::t('module', 'jk') ?></p>
            </div>
            <div class="icon">
                <?= Yii::$app->params['module']['jk']['icon'] ?>
            </div>
            <a href="<?= Url::to(['/jk/']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ДМС</h3>
                <p>Медицинское страхование</p>
            </div>
            <div class="icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <a href="#" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Путёвки</h3>
                <p>Путёвки и лечение</p>
            </div>
            <div class="icon">
                <i class="fas fa-plane"></i>
            </div>
            <a href="#" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ПП</h3>
                <p>Пенсионная программа</p>
            </div>
            <div class="icon">
                <i class="fas fa-hands-helping"></i>
            </div>
            <a href="#" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>


</div>