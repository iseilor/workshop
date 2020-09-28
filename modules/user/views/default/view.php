<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = Icon::show('user').$model->fio;
$this->params['breadcrumbs'][] = ['label' =>Icon::show('users'). 'Сотрудники', 'url' => ['/users']];
$this->params['breadcrumbs'][] = $this->title;

?>
    <div class="row">
        <div class="col-md-4 d-none">
            <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-info">
                    <h3 class="widget-user-username"><?=$model->fio?></h3>
                    <h5 class="widget-user-desc"><?=$model->position?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="/img/user1-128x128.jpg" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">3,200</h5>
                                <span class="description-text">SALES</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">13,000</h5>
                                <span class="description-text">FOLLOWERS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">35</h5>
                                <span class="description-text">PRODUCTS</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <div class="col-md-12">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'fio',
                    'position',
                    'email:email',
                    'work_phone',
                    'work_department_full',
                    'work_address'
                ],
            ]) ?>

        </div>

    </div>


