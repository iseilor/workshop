<?php

use app\modules\admin\Module;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */


$this->title = '<i class="fas fa-info"></i>' . ' ' . Module::t('module', 'Admin');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="nav-icon fas fa-tachometer-alt"></i> Панель администратора</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h1><i class="fas fa-users"></i> Пользователи</h1>
                        <?= Html::ul(
                            [
                                Html::a('Список пользователей', Url::to('admin/user/')),
                                Html::a('Дети сотрудников', Url::to('/user/user-child')),
                                Html::a('Active Directory', Url::to('admin/ad/')),
                                Html::a('Социальные категории', Url::to('admin/user-social/')),
                            ],
                            [
                                'item' => function ($item, $index) {
                                    return Html::tag(
                                        'li',
                                        $item
                                    );
                                }
                            ]
                        ) ?>
                        <h1><i class="fas fa-bullhorn"></i> Новости</h1>
                        <?= Html::ul(
                            [
                                Html::a('Новости', Url::to('news/news/'))
                            ],
                            [
                                'item' => function ($item, $index) {
                                    return Html::tag(
                                        'li',
                                        $item
                                    );
                                }
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-4">
                        <h1><i class="fas fa-table"></i> Справочники</h1>
                        <?= Html::ul(
                            [
                                Html::a('МРФы', Url::to('admin/mrf')),
                                Html::a('Пенсионный возраст', Url::to('admin/retirement')),
                                Html::a('Прожиточные минимумы', Url::to('jk/min/admin')),
                                Html::a('Статусы заявок', Url::to('jk/order-status')),
                            ],
                            [
                                'item' => function ($item, $index) {
                                    return Html::tag(
                                        'li',
                                        $item
                                    );
                                }
                            ]
                        ) ?>

                    </div>
                    <div class="col-md-4">
                        <h1><i class="fas fa-home"></i> Жилищная кампания</h1>
                        <?= Html::ul(
                            [
                                Html::a('Калькуляторы процентов', Url::to('jk/percent')),
                                Html::a('Калькуляторы займов', Url::to('jk/zaim')),
                                Html::a('Заявки', Url::to('jk/order/admin')),
                                Html::a('Вопросы', Url::to('jk/faq/admin')),
                                Html::a('Документы', Url::to('jk/doc/admin')),
                                Html::a('Типы займов', Url::to('jk/zaim-type/index')),
                                Html::a('Корпоративная норма', Url::to('jk/corp-norm')),
                            ],
                            [
                                'item' => function ($item, $index) {
                                    return Html::tag(
                                        'li',
                                        $item
                                    );
                                }
                            ]
                        ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>