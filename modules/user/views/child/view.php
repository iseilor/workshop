<?php

use app\modules\user\models\Child;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Child */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Module::t('child', 'Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

// Отображение полей с файлами
function childViewFieldFile($model, $field)
{
    return [
        'label' => $model->attributeLabels()[$field],
        'format' => 'raw',
        'value' => ($model->{$field}) ? Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()[$field],
            Url::to(['/' . Yii::$app->params['module']['child']['filePath'] . $model->id . '/' . $model->{$field}]),
            ['target' => '_blank']) : '',
    ];
}

?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">

            <div class="card-body">
                <p>
                    <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'created_at:datetime',
                        [
                            'attribute' => 'user_id',
                            'format' => 'raw',
                            'value' => $model->getCreatedUserLink(),
                        ],
                        'fio',
                        [
                            'attribute' => 'gender',
                            'value' => Child::getGenderList()[$model->gender],
                        ],
                        'date:date',
                        childViewFieldFile($model, 'file_passport'),
                        childViewFieldFile($model, 'file_registration'),
                        childViewFieldFile($model, 'file_birth'),
                        childViewFieldFile($model, 'file_address'),
                        childViewFieldFile($model, 'file_ejd'),
                        childViewFieldFile($model, 'file_personal'),
                        [
                            'attribute' => 'is_invalid',
                            'value' => (isset($model->is_invalid) && $model->is_invalid) ? 'Да' : 'Нет',
                        ],
                        childViewFieldFile($model, 'file_invalid'),
                        childViewFieldFile($model, 'file_posobie'),
                        [
                            'attribute' => 'is_study',
                            'value' => (isset($model->is_study) && $model->is_study) ? 'Да' : 'Нет',
                        ],
                        childViewFieldFile($model, 'file_study'),
                        childViewFieldFile($model, 'file_scholarship'),
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>