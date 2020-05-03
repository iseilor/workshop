<?php

/* @var $this yii\web\View */
$this->title = '<span class="badge bg-danger">Админка</span>';
$this->params['breadcrumbs'][] = ['label' => 'ЖК', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url; ?>

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><?=Icon::show('tools')?>Панель администратора жилищной кампании</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <li>Калькуляторы
                    <ul>
                        <li><?=Html::a(Icon::show('percent').'Проценты',Url::to(['/jk/percent/']))?></li>
                        <li><?=Html::a(Icon::show('wallet').'Займы',Url::to(['/jk/zaim/']))?></li>
                    </ul>
                </li>
                <li><?=Html::a(Icon::show('ruble-sign').'Все заявки',Url::to(['/jk/order/']))?>
                    <ul>
                        <li>Новые</li>
                        <li>В работе</li>
                        <li>На согласовании</li>
                        <li>На комиссии</li>
                        <li>Отозваны</li>
                    </ul>
                </li>
                <li><?=Html::a(Icon::show('comments').'Сообщения куратору <span class="badge bg-danger">5</span>',Url::to(['/jk/messages']))?></li>
                <li>Справочники
                    <ul>
                        <li><?=Html::a(Icon::show('list').'Статусы заявок',Url::to(['/jk/order-status']))?></li>
                        <li><?=Html::a(Icon::show('users').'Социальные группы',Url::to(['/jk/social']))?></li>
                        <li><?=Html::a(Icon::show('undo').'Причины возвратов',Url::to(['/jk/order-stop']))?></li>
                    </ul>
                </li>
               <li><?=Html::a(Icon::show('file-word').'Документы',Url::to(['/jk/doc/admin']))?></li>
               <li><?=Html::a(Icon::show('question').'Вопросы',Url::to(['/jk/faq/admin']))?></li>
            </ul>
        </div>
        <div class="card-footer">
            <span class="text-danger"><?=Icon::show('exclamation')?> Будьте очень внимательны при работе с административной панелью</span>
        </div>
    </div>
</section>