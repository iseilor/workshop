<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        // Убрал пока ребята не поправят, т.к. если открыть на просмотр после 1-ого шага, то это поле ещё не определено
        /*[
            'attribute'=>'is_mortgage',
            'value'=>$model::getMortgageList()[$model->is_mortgage]
        ],*/
        [
            'label' => $model->attributeLabels()['ipoteka_target'],
            'value' => $model::getIpotekaTargetName($model->ipoteka_target),
        ],
        'ipoteka_size:currency',
        'ipoteka_user:currency',
        'ipoteka_percent',
        'ipoteka_last_date:date',
        'ipoteka_grafic:ntext',
        [
            'label' => $model->attributeLabels()['ipoteka_file_dogovor'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_dogovor) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_dogovor'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_dogovor]),
                ['target' => '_blank']) : '',
        ],
        [
            'label' => $model->attributeLabels()['ipoteka_file_grafic_first'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_grafic_first) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_grafic_first'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_grafic_first]),
                ['target' => '_blank']) : '',
        ],
        [
            'label' => $model->attributeLabels()['ipoteka_file_grafic_now'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_grafic_now) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_grafic_now'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_grafic_now]),
                ['target' => '_blank']) : '',
        ],
        [
            'label' => $model->attributeLabels()['ipoteka_file_refenance'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_refenance) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_refenance'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_refenance]),
                ['target' => '_blank']) : '',
        ],
        [
            'label' => $model->attributeLabels()['ipoteka_file_spravka'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_spravka) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_spravka'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_spravka]),
                ['target' => '_blank']) : '',
        ],
        [
            'label' => $model->attributeLabels()['ipoteka_file_bank_approval'],
            'format' => 'raw',
            'value' => ($model->ipoteka_file_bank_approval) ? Html::a(
                Icon::show('file-pdf') . $model->attributeLabels()['ipoteka_file_bank_approval'],
                Url::to(['/' . Yii::$app->params['module']['jk']['order']['filePath'] . $model->id . '/' . $model->ipoteka_file_bank_approval]),
                ['target' => '_blank']) : '',
        ],
    ],
]) ?>