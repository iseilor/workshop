<?php

/* @var $this yii\web\View */
$icon = '<i class="nav-icon fas fa-home"></i>';
$this->title = $icon . ' Жилищная компания';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url; ?>

<div class="alert alert-default-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> Информация!</h5>
    <ul>
        <li>Если у вас уже <u>есть кредит в банке</u>, и вы бы хотели по нему рассчитать компенсацию
            процентов, то используете <a class="btn bg-primary btn-xs btn-a"
                                         href="<?= Url::to(['/jk/percent/create']); ?>"><i
                        class="fas fa-calculator"></i>
                Калькулятор процентов</a></li>

        <li>Если вы только <u>планируете взять кредит в банке</u> и рассчитываете на помощь со стороны
            компании, то используете <a class="btn bg-primary btn-xs btn-a"
                                        href="<?= Url::to(['/jk/zaim/create']); ?>"><i
                        class="fas fa-calculator"></i>
                Калькулятор займа</a>
        </li>
        <li>
            Ответы на часто возникающие вопросы ищете в разделе с <a class="workshop-link"
                                                                     href="<?= Url::to
                                                                     (
                                                                         ['/jk/faq']
                                                                     ); ?>">вопросами</a>
        </li>
        <li>
            Примеры бланков заявлений и другую нормативную документацию вы можете найти в разделе
            с <a class="workshop-link"
                 href="<?= Url::to(['/jk/doc']); ?>">
                документами</a>
        </li>
    </ul>
</div>

<div class="row">

    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Калькулятор</h3>
                <p>Калькулятор % или займа</p>
            </div>
            <div class="icon">
                <i class="fas fa-calculator"></i>
            </div>
            <a href="<?= Url::to(['/jk/default/calc']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!--
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Калькулятор %</h3>
                <p>Калькулятор процентов</p>
            </div>
            <div class="icon">
                <i class="fas fa-calculator"></i>
            </div>
            <a href="<?= Url::to(['/jk/percent/create']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Займ</h3>
                <p>Калькулятор займа</p>
            </div>
            <div class="icon">
                <i class="fas fa-ruble-sign"></i>
            </div>
            <a href="<?= Url::to(['/jk/zaim/create']); ?>" class="small-box-footer">Перейти <i
                        class="fas
             fa-arrow-circle-right"></i></a>
        </div>
    </div>
    -->
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Заявка</h3>
                <p>Подать заявку</p>
            </div>
            <div class="icon">
                <i class="fas fa-file"></i>
            </div>
            <a href="<?= Url::to(['/jk/order/create']); ?>" class="small-box-footer">Перейти <i
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
    </div>
</div>