<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\helpers\Url;

?>

<div class="card bg-light">
    <div class="card-header text-muted border-bottom-0">
        <?=$model->category->badge?>
        <span class="float-right"><?= Icon::show('calendar-alt') .date('d.m.Y H:i',$model->date)?></span>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-7">
                <h2 class="lead"><b><?= Icon::show('user') ?> <?= $model->guest_fio ?></b></h2>
                <p class="text-muted text-sm"><?=$model->title?></p>
                <hr/>
                <ul class="ml-4 mb-0 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><?= Icon::show('calendar-alt', ['class' => 'fa-lg']) ?></span>
                        Дата рождения: <?=date('d.m.Y',$model->birth_date)?>
                    </li>
                    <li class="small"><span class="fa-li"><?= Icon::show('map-marker-alt', ['class' => 'fa-lg']) ?></span>
                        Место рождения:  <?=$model->birth_place?>
                    </li>
                </ul>
            </div>
            <div class="col-5 text-center">
                <img src="<?= Url::home() ?>img/st/guest/<?= $model->guest_photo ?>" class="img-circle img-fluid">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <?php
        $file = Yii::getAlias('@app') .'/web/'. Yii::$app->params['module']['st']['guest']['path'] . $model->id . '/' . $model->video;
        ?>
        <?php if ($model->video && file_exists($file)): ?>
            <?php echo $this->render('video', ['model' => $model]); ?>
        <?php endif; ?>
        <?php echo $this->render('info', ['model' => $model]); ?>
    </div>
</div>
