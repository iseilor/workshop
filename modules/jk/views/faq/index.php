<?php

$this->title = "<i class='fas fa-question'></i> Вопросы";
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\ListView; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <p>Для получения ответа на часто задаваемые вопросы нажмите на него мышкой</p>
                <div id="accordion">
                    <?php
                    echo ListView::widget(
                        [
                            'dataProvider' => $dataProvider,
                            'itemView' => 'index_item',
                        ]
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

