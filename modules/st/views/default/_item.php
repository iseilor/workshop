<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\helpers\Url;

?>

<div class="card bg-light">
    <div class="card-header text-muted border-bottom-0">
        <span class="badge bg-purple"> <?=Icon::show('running')?> Спортсмены</span>
        <span class="float-right"><?=Icon::show('calendar-alt')?>Эфир: 04.09.2020 11:00</span>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-7">
                <h2 class="lead"><b><?=Icon::show('user')?> <?=$model->guest_fio?></b></h2>
                <p class="text-muted text-sm">альпинист-высотник</p>
                <hr/>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <!--<li class="small"><span class="fa-li"><?= Icon::show('cubes', ['class' => 'fa-lg']) ?></span> Блок: <span class="badge bg-purple">B2B</span></li>
      -->
                    <li class="small"><span class="fa-li"><?=Icon::show('calendar-alt',['class'=>'fa-lg'])?></span> Дата рождения: 04.03.1988</li>
                    <li class="small"><span class="fa-li"><?=Icon::show('map-marker-alt',['class'=>'fa-lg'])?></span> Место рождения: РФ, Москва</li>
                </ul>
            </div>
            <div class="col-5 text-center">
                <img src="<?= Url::home() ?>img/st/guest/<?=$model->guest_photo?>" class="img-circle img-fluid">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="text-right">
            <a href="#" class="btn btn-sm bg-purple float-left">
                <?=Icon::show('video')?>
            </a>
            <a href="#" class="btn btn-sm bg-purple">
                <?=Icon::show('qrcode')?>
            </a>
            <a href="#" class="btn btn-sm bg-purple">
                <?=Icon::show('envelope')?>
            </a>
            <a href="#" class="btn btn-sm btn-primary">
                <?=Icon::show('info-circle')?>
            </a>
        </div>
    </div>
</div>
