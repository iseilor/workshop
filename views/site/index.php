<?php
/* @var $this yii\web\View */
$this->title = 'РВУ 1.0';

use yii\helpers\Url; ?>
<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ЖК</h3>
                <p>Жилищная компания</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="<?= Url::to(['jk/default/index']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ДМС</h3>
                <p>Медицинское страхование</p>
            </div>
            <div class="icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <a href="<?= Url::to(['site/dev']); ?>" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Путёвки</h3>
                <p>Путёвки и лечение</p>
            </div>
            <div class="icon">
                <i class="fas fa-plane"></i>
            </div>
            <a href="/zhp/" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Отчёты</h3>
                <p>Еженедельные отчёты</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="<?= Url::to(['site/dev']); ?>" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>Чат</h3>
                <p>Корпоративный чат</p>
            </div>
            <div class="icon">
                <i class="fas fa-comments"></i>
            </div>
            <a href="<?= Url::to(['site/dev']); ?>" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>