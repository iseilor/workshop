<?php

use app\modules\admin\Module;
use yii\helpers\Url;

/* @var $this yii\web\View */


$this->title = '<i class="fas fa-info"></i>'.' '.Module::t('module', 'Admin');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>Пользователи</h3>
                <p>Сотрудники компании</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="<?= Url::to(['/admin/mrf']); ?>" class="small-box-footer">Перейти <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>МРФы</h3>
                <p>Макро-региональные филиалы</p>
            </div>
            <div class="icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <a href="<?= Url::to(['/admin/mrf']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>ЖК</h3>
                <p>Жилищная кампания</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="<?= Url::to(['/jk/admin']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>