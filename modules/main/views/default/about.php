<?php

use app\modules\main\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

$this->title = Icon::show('info') . Module::t('module', 'About project');
$this->params['breadcrumbs'][] = $this->title; ?>

<div class="row">
    <div class="col-12">
        <div class="invoice p-3 mb-3">
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> ПАО Ростелеком, Макрорегиональный филиал "ЦЕНТР"
                        <small class="float-right"><?=Icon::show('calendar-alt'). date('d.m.Y') ?></small>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <?php
                    echo  Html::img(
                        Yii::$app->homeUrl .'logo/logo.png',
                        [
                            'class' => 'img-fluid pad',
                        ]
                    );
                    ?>
                </div>
                <div class="col-10">
                    <p><a href="/">HR-Портал</a> макрорегионального филиала <strong>«Центр» ПАО «Ростелеком»</strong> позволяет в режиме реального времени:</p>
                    <ul>
                        <li>каждому работнику МРФ «Центр» видеть доступные для него льготы; рассчитывать их максимальный размер; вводить и отслеживать статус рассмотрения электронных заявок;</li>
                        <li>ответственным по Программе работать с единым хранилищем документов; формировать в автоматическом режиме отчет «Предложения на жилищную комиссию»;</li>
                        <li>руководителям проводить электронные согласования и принимать управленческие решения on-line.</li>
                    </ul>
                    <p>
                        Программное обеспечение <a href="/">HR-Портала</a> разработано специалистами МРФ «Центр» на базе импортонезависимых технологий и решений.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>