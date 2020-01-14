<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
use yii\helpers\Url;
?>

<div class="row">
    <div class="col-md-3">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ЖК</h3>
                <p>Жилищная компания</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="<?= Url::to(['/jk/']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Админка</h3>
                <p>Административная панель</p>
            </div>
            <div class="icon">
                <i class="fas fa-tools"></i>
            </div>
            <a href="<?=Url::to(['/admin/']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>