<?php

use app\components\grid\LinkColumn;
use app\modules\jk\models\Agreement;
use app\modules\jk\models\AgreementSearch;
use app\modules\user\models\Child;
use yii\grid\GridView;
use yii\helpers\Url;

$searchModel = new AgreementSearch();
$dataProvider = $searchModel->search(['AgreementSearch'=>['order_id'=>$model->id]]);
$approvals = Agreement::find()->where(['order_id'=>$model->id])->andWhere(['not',['approval_at'=>null]])->all();

$countAll = $dataProvider->count;
$countApporoval = count($approvals);
$percent = number_format( $countApporoval/$countAll * 100, 0)
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
        'approvalLabel:html'
        /*[
            'class' => LinkColumn::class,
            'attribute' => 'fio',
            'url' => function ($data) {
                return Url::to(['/user/child/' . $data->id]);
            },
        ],
        [
            'attribute'=>'gender',
            'content'=>function($data){
                return Child::getGenderList()[$data->gender];
            }
        ],
        'date:date',
        'age',
        'passportLink:html',
        'birthLink:html',
        'personalDataLink:html',
        [
            'attribute' => 'is_invalid',
            'content'=>function($data){
                return (isset($data->is_invalid) && $data->is_invalid) ? '<span class="badge badge-danger">Да</span>' : 'Нет';
            }
        ],
        [
            'attribute' => 'is_study',
            'content'=>function($data){
                return (isset($data->is_study) && $data->is_study) ? '<span class="badge badge-info">Да</span>' : 'Нет';
            }
        ],*/
    ],
]); ?>