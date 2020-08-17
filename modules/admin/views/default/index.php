<?php

use app\modules\admin\Module;
use kartik\icons\Icon;
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
                                Html::a(Icon::show('users').'Список пользователей', Url::to('admin/user/')),
                                Html::a(Icon::show('baby').'Дети сотрудников', Url::to('/user/user-child')),
                                Html::a(Icon::show('lock').'Active Directory', Url::to('admin/ad/')),
                                Html::a(Icon::show('users').'Социальные категории', Url::to('admin/user-social/')),
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
                                Html::a(Icon::show('bullhorn').'Новости', Url::to('news/news/'))
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
                                Html::a(Icon::show('sitemap').'МРФы', Url::to('admin/mrf')),
                                Html::a(Icon::show('restroom').'Пенсионный возраст', Url::to('admin/retirement')),
                                Html::a(Icon::show('list').'Прожиточные минимумы', Url::to('jk/min/admin')),
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
                        <h3><?=Icon::show('home').\app\modules\jk\Module::t('module','jk')?></h3>
                        <?=$this->render('@app/modules/jk/views/admin/index_data')?>
                        <hr/>
                        <?=$this->render('@app/modules/jk/views/admin/index_dir')?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>