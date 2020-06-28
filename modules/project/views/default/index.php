<?php

use kartik\icons\Icon;
use yii\helpers\Url;

$icon = Icon::show('folder-open');
$this->title = $icon . ' Проекты';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-3">
        <a href="<?=Url::to(['/project/project'],true)?>" class='small-box-footer'>
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>Проекты</h3>
                    <p>Управление проектами</p>
                </div>
                <div class="icon"><?=Icon::show('folder-open')?></div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?=Url::to(['/project/task'],true)?>" class='small-box-footer'>
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>Задачи</h3>
                    <p>Выполненные задачи</p>
                </div>
                <div class="icon"><?=Icon::show('tasks')?></div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?=Url::to(['/project/report'],true)?>" class='small-box-footer'>
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>Отчёты</h3>
                    <p>По задачам и проектам</p>
                </div>
                <div class="icon"><?=Icon::show('table')?></div>
            </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="<?=Url::to(['/project/emails'],true)?>" class='small-box-footer'>
            <div class="small-box bg-gradient-primary">
                <div class="inner">
                    <h3>Email</h3>
                    <p>Отправленные сообщения</p>
                </div>
                <div class="icon"><?=Icon::show('envelope')?></div>
            </div>
        </a>
    </div>
</div>