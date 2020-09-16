<?php
/* @var $model app\modules\kr\models\Curator */

use kartik\icons\Icon;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="card bg-light">
    <div class="card-header text-muted border-bottom-0">
        <?= Icon::show('user-graduate') . $model->position; ?>
    </div>
    <div class="card-body pt-0">
        <div class="row">
            <div class="col-7">
                <h2 class="lead"><b><?= $model->fio; ?></b></h2>
                <p class="text-muted text-sm d-none"><b><?= $model->fio; ?></b> / <?= $model->fio; ?></p>
                <hr/>
                <ul class="ml-4 mb-1 fa-ul text-muted">
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?= Html::mailto($model->email,
                            $model->email, ['target' => '_blank']) ?></li>
                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <?=$model->phone ?></li>
                </ul>
                <?php echo $this->render('description',['model'=>$model]); ?>
            </div>
            <div class="col-5 text-center">
                <img src="<?= Url::home() . Yii::$app->params['module']['kr']['curator']['path'] . $model->img ?>" class="img-circle img-fluid">
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
