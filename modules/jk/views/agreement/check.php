<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Agreement */

$this->title = Yii::t('app', 'Согласование заявки');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Согласование заявки сотрудника на участие в жилищной кампании</h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Icon::show('thumbs-up') . 'Согласовано', ['class' => 'btn btn-success','name'=>'is_approval','value'=>1]) ?>
                    <?= Html::submitButton(Icon::show('thumbs-down') . 'Не согласовано', ['class' => 'btn btn-danger','name'=>'is_approval','value'=>0]) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>