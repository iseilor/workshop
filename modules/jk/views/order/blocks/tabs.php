<?php

use app\modules\jk\models\OrderStageSearch;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $model app\modules\jk\models\Order */

?>
<div class="card-header p-0 border-bottom-0">
    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab"
               aria-controls="custom-tabs-three-home" aria-selected="true">
                <?= Icon::show('list') ?>Основные параметры заявки
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab"
               aria-controls="custom-tabs-three-profile" aria-selected="false">
                <?= Icon::show('history') ?>История работы над заявкой
            </a>
        </li>
    </ul>
</div>
<div class="card-body">
    <div class="tab-content" id="custom-tabs-three-tabContent">
        <div class="tab-pane fade active show" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
            <?= DetailView::widget(
                [
                    'model' => $model,
                    'attributes' => [
                        [
                            'format' => 'raw',
                            'label' => 'Заявка',
                            'value' => Html::a('№28 (Открыть заявку на просмотр в отдельном окне ' . Icon::show('external-link-alt').')',
                                ['/jk/order/' . $model->id], ['target' => '_blank']),
                        ],
                        'created_at:datetime',
                        'createdUserLink:html',
                        'createdUser.position',
                        'createdUser.work_department_full',
                        'createdUser.work_address',
                        'typeName',
                        'status.label:html'
                    ],
                ]
            ) ?>
        </div>
        <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
            <?php
            // История движения заявки
            $orderStageSearchModel = new OrderStageSearch();
            $stages = $orderStageSearchModel->search(['OrderStageSearch' => ['order_id' => $model->id]]);
            echo GridView::widget([
                'dataProvider' => $stages,
                'pager' => [
                    'class' => 'app\widgets\LinkPager',
                ],
                'columns' => [
                    'created_at:datetime',
                    'createdUserLink:html',
                    'status.label:html',
                    'comment:html'
                ],
            ]) ?>
        </div>
    </div>
</div>