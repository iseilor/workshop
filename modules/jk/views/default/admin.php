<?php

/* @var $this yii\web\View */
$icon = '<i class="nav-icon fas fa-home"></i>';
$this->title = $icon . ' Жилищная компания <span class="badge bg-danger">Админка</span>';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url; ?>



<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Проценты</h3>
                <p>Калькулятор процентов</p>
            </div>
            <div class="icon">
                <i class="fas fa-percent"></i>
            </div>
            <a href="<?= Url::to(['/jk/percent/create']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Займы</h3>
                <p>Калькуляторы займа</p>
            </div>
            <div class="icon">
                <i class="fas fa-ruble-sign"></i>
            </div>
            <a href="<?= Url::to(['/jk/zaim/create']); ?>" class="small-box-footer">Перейти <i
                        class="fas
             fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Заявки</h3>
                <p>Подать заявку</p>
            </div>
            <div class="icon">
                <i class="fas fa-file"></i>
            </div>
            <a href="<?= Url::to(['/']); ?>" class="small-box-footer">Перейти <i
                    class="fas
             fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Вопросы</h3>
                <p>Ответы на вопросы</p>
            </div>
            <div class="icon">
                <i class="fas fa-question"></i>
            </div>
            <a href="<?= Url::to(['/jk/faq']); ?>" class="small-box-footer">Перейти <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Документы</h3>
                <p>Нормативная документация</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-word"></i>
            </div>
            <a href="<?= Url::to(['/jk/doc']); ?>" class="small-box-footer">Перейти <i class="fas
            fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ПМ 2020</h3>
                <p>Прожиточный минимум 2020</p>
            </div>
            <div class="icon">
                <i class="fas fa-wallet"></i>
            </div>
            <a href="<?= Url::to(['/jk/min/admin']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!--<div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Куратор</h3>
                <p>Горшкова Лада</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
            <a href="<?= Url::to(['site/dev']); ?>" class="small-box-footer">Перейти <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>-->
</div>