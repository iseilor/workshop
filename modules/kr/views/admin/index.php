<?php
/* @var $this yii\web\View */

$this->title = 'Админка КР';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Админка КР</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <h3>Справочники</h3>
                <?php echo $this->render('block'); ?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>