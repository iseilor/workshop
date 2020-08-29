<?php

use app\components\grid\LinkColumn;
use app\modules\jk\models\Agreement;
use app\modules\jk\models\AgreementSearch;
use yii\grid\GridView;
use yii\helpers\Url;

$searchModel = new AgreementSearch();
$dataProvider = $searchModel->search(['AgreementSearch'=>['order_id'=>$model->id]]);
$approvals = Agreement::find()->where(['order_id'=>$model->id])->andWhere(['not',['approval_at'=>null]])->all();

$countAll = $dataProvider->count;
$countApporoval = count($approvals);

// Если TOP-менеджер то у него согласующих нет
if ($countAll>0){
    $percent = number_format( $countApporoval/$countAll * 100, 0);
}else{
    $percent = 100;
}

?>
    Общий процесс согласования заявки:
    <div class="progress">
        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="<?=$percent?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percent?>%">
            <span><?=$percent?>%</span>
        </div>
    </div>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => LinkColumn::class,
            'attribute' => 'id',
            'url' => function ($data) {
                return Url::to(['/jk/agreement/' . $data->id]);
            },
        ],
        [
            'class' => LinkColumn::class,
            'attribute' => 'user.fio',
            'url' => function ($data) {
                return Url::to(['/user/' . $data->user_id]);
            },
        ],
        'user.position',
        'user.work_phone',
        'user.email:email',
        'receipt_at:datetime',
        'approval_at:datetime',
        'approvalBadge:html'
    ],
]); ?>