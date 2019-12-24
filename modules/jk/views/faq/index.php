<?php

$this->title = "Частые вопросы";
$this->params['breadcrumbs'][] = ['label' => 'Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\ListView; ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-question"></i> <?= $this->title; ?></h3>
            </div>
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

