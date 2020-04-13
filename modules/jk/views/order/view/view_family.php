<?php

use app\modules\jk\models\Order;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'attribute' => 'social_id',
            'value' => $model->social->title,
        ],
        'resident_count',
        [
            'attribute' => 'resident_type',
            'value' => Order::getResidentTypeList()[$model->resident_type],
        ],
        'family_address:ntext',
        'resident_own:ntext',
        'family_own:ntext',
        'family_rent:ntext',
        'family_deal:ntext',

        [
            'attribute' => 'file_family_big',
            'format' => 'raw',
            'value' => ($model->file_family_big) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['file_family_big'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_family_big]),
                ['target' => '_blank']) : '',
        ],
        [
            'attribute' => 'file_social_protection',
            'format' => 'raw',
            'value' => ($model->file_social_protection) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['file_social_protection'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_social_protection]),
                ['target' => '_blank']) : '',
        ],
        [
            'attribute' => 'file_rent',
            'format' => 'raw',
            'value' => ($model->file_rent) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['file_rent'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_rent]),
                ['target' => '_blank']) : '',
        ],
        [
            'attribute' => 'file_social_contract',
            'format' => 'raw',
            'value' => ($model->file_social_contract) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['file_social_contract'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->file_social_contract]),
                ['target' => '_blank']) : '',
        ],

    ],
]) ?>

