<?php

use app\modules\jk\models\OrderStatus;
use app\modules\user\models\User;
use kartik\icons\Icon;

/* @var $model app\modules\jk\models\OrderStage */

$status = OrderStatus::findOne($model->status_id);
$user = User::findOne($model->created_by);

?>

<?= Icon::show($status->icon, ['class' => 'bg-' . $status->color]) ?>
<div class="timeline-item">
    <span class="time"><i class="fas fa-clock"></i> <?= Yii::$app->formatter->asDatetime($model->created_at) ?></span>
    <h3 class="timeline-header no-border"><a href="#"><?= $user->fio ?></a>
        заявка переведена на этап <span class="badge bg-<?=$status->color?>" title="<?= $status->description ?>"><?=  Icon::show($status->icon)
            .' '.$status->title_long ?></span></h3>
    <div class="timeline-body">
        <?= $model->comment ?>
    </div>
    <!--<div class="timeline-footer">
        ...
    </div>-->
</div>