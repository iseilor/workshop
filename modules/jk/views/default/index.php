<?php
/* @var $this yii\web\View */
$this->title = 'Жилищная компания';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Url; ?>
<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-primary">

            <div class="inner">
                <h3>Калькулятор %</h3>
                <p>Калькулятор процентов</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="<?=Url::to(['/jk/percent/create']);?>" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>Займ</h3>
                <p>Калькулятор займа</p>
            </div>
            <div class="icon">
                <i class="fas fa-heartbeat"></i>
            </div>
            <a href="<?=Url::to(['/jk/zaim/create']);?>" class="small-box-footer">Перейти <i
                        class="fas
             fa-arrow-circle-right"></i></a>
        </div>
    </div>
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
            <a href="<?=Url::to(['/']);?>" class="small-box-footer">Перейти <i
                        class="fas
             fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>F.A.Q</h3>
                <p>Частые вопросы</p>
            </div>
            <div class="icon">
                <i class="fas fa-question"></i>
            </div>
            <a href="<?=Url::to(['/jk/faq']);?>" class="small-box-footer">Перейти <i
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
            <a href="<?=Url::to(['/jk/doc']);?>" class="small-box-footer">Перейти <i class="fas
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
            <a href="<?=Url::to(['site/dev']);?>" class="small-box-footer">Перейти <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>