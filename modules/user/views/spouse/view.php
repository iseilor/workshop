<?php

use app\modules\user\models\Spouse;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\Spouse */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Module::t('spouse', 'Spouses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>

            <div class="card-body">
                <p>
                    <?= Html::a(Icon::show('edit') . Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a(Icon::show('trash') . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
                            'attribute' => 'created_by',
                            'format' => 'raw',
                            'value' => $model->getCreatedUserLink(),
                        ],
                        [
                            'attribute' => 'type',
                            'value' => Spouse::getTypeList()[$model->type],
                        ],
                        [
                            'attribute' => 'user_id',
                            'format' => 'raw',
                            'value' => $model->getCreatedUserLink(),
                        ],
                        'fio',
                        [
                            'attribute' => 'gender',
                            'value' => Spouse::getGenderList()[$model->gender],
                        ],
                        'date:date',
                        viewFieldFile($model, 'marriage_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->marriage_file),
                        'passport_series',
                        'passport_number',
                        'passport_date:date',
                        'passport_department',
                        'passport_code',
                        'passport_registration',
                        'address_fact',
                        viewFieldFile($model, 'passport_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->passport_file),
                        viewFieldFile($model, 'edj_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->edj_file),
                        viewFieldFile($model, 'registration_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->registration_file),

                        [
                            'attribute' => 'is_work',
                            'value' => (isset($model->is_work) && $model->is_work) ? 'Да' : 'Нет',
                        ],
                        [
                            'attribute' => 'is_rtk',
                            'value' => (isset($model->is_rtk) && $model->is_rtk) ? 'Да' : 'Нет',
                        ],
                        [
                            'attribute' => 'is_do',
                            'value' => (isset($model->is_do) && $model->is_do) ? 'Да' : 'Нет',
                        ],

                        viewFieldFile($model, 'explanatory_note_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->explanatory_note_file),
                        viewFieldFile($model, 'work_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->work_file),
                        viewFieldFile($model, 'unemployment_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->unemployment_file),
                        viewFieldFile($model, 'salary_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->salary_file),

                        viewFieldFile($model, 'personal_data_file', Yii::$app->params['module']['spouse']['filePath'] . $model->id . '/' . $model->personal_data_file),

                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
