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
                <h3>ЖК</h3>
                <p>Жилищная компания</p>
            </div>
            <div class="icon">
                <i class="fas fa-home"></i>
            </div>
            <a href="<?= Url::to(['/jk/admin']); ?>" class="small-box-footer">Перейти <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>