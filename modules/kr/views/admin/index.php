<?php
/* @var $this yii\web\View */

use app\modules\kr\Module;
use kartik\icons\Icon;

$this->title = Icon::show('tools').'Админка';
$this->params['breadcrumbs'][] = ['label' => Icon::show('users').Module::t('module','kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><?=$this->title?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <h3><?=Icon::show('list')?> Справочники</h3>
                <?php echo $this->render('block'); ?>
                <h3><?=Icon::show('video')?> Видео-инструкции</h3>
                <?php echo $this->render('video'); ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>