<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\helpers\Url;
?>

<div class="card bg-light">
    <div class="card-header text-muted border-bottom-0">
        <?=$model->position;?>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-7">
                <h2 class="lead"><b><?=$model->fio;?></b></h2>
                <p class="text-muted text-sm d-none"><b><?=$model->fio;?></b> / <?=$model->fio;?></p>
                <hr/>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><?=Icon::show('cubes',['class'=>'fa-lg'])?></span> Блок: <span class="badge bg-purple">B2B</span></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?=$model->email;?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <?=$model->phone;?></li>
                </ul>
            </div>
            <div class="col-5 text-center">
                <img src="<?= Url::home() ?>img/kr/curators/<?=$model->img?>" alt="<?=$model->fio?>" class="img-circle img-fluid">
            </div>
        </div>
    </div>
    <div class="card-footer d-none">
        <div class="text-right">
            <a href="#" class="btn btn-sm bg-teal">
                <i class="fas fa-comments"></i>
            </a>
            <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-user"></i> Профиль
            </a>
        </div>
    </div>
</div>
