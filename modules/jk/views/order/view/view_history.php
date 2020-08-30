<?php

/* @var $stages app\modules\jk\models\OrderStage */
/* @var $model app\modules\jk\models\Order */

use app\modules\jk\models\OrderStageSearch;
use yii\grid\GridView;

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
        'comment:html',
    ],
]);