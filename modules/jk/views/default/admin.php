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
                        <li>Проценты</li>
                        <li>Займы</li>
                    </ul>
                </li>
                <li>Заявки
                    <ul>
                        <li>Новые</li>
                        <li>В работе</li>
                        <li>На согласовании</li>
                        <li>На комиссии</li>
                        <li>Отозваны</li>
                    </ul>
                </li>
                <li>Справочники
                    <ul>
                        <li>Статусы заявок</li>
                        <li><?=Html::a(Icon::show('users').'Социальные группы',Url::to(['/jk/social']))?></li>
                        <li><?=Html::a(Icon::show('undo').'Причины возвратов',Url::to(['/jk/order-stop']))?></li>
                    </ul>
                </li>
                <li>Документы</li>
                <li>Вопросы</li>
            </ul>
        </div>
        <div class="card-footer">
            <span class="text-danger"><?=Icon::show('exclamation')?> Будьте очень внимательны при работе с административной панелью</span>
        </div>
    </div>
</section>