<?php

use app\modules\user\models\User;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

use yii\jui\DatePicker;
use yii\widgets\MaskedInput;
use app\modules\jk\models\Order;

$user = User::findOne(Yii::$app->user->identity->id);
?>


<div class="card card-solid card-secondary  ">
    <div class="card-header with-border">
        <h3 class="card-title">Обработка персональных данных</h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <hr/>
                <h3><?=  Yii::$app->user->identity->fio ?></h3>

                <?= $form->field($model, 'file_agree_personal_data_form', [
                    'template' => getFileInputTemplate($model->file_agree_personal_data, $model->attributeLabels()['file_agree_personal_data_form'] . '.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>

            </div>
        </div>

        <?php if($spose->type == 1): ?>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <h3><?= $spose->fio ?></h3>
                <?= $form->field($spose, 'personal_data_file_form', [
                    'template' => getFileInputTemplate($spose->personal_data_file,  $spose->attributeLabels()['personal_data_file'].'.pdf'),
                ])->fileInput(['class' => 'custom-file-input']) ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if (is_array($usermd->children) && count($usermd->children) > 0):?>
            <?php foreach($usermd->children as $child): ?>
                <div  class="row">
                    <div class="col-md-12">
                        <hr/>
                        <h3><?= $child->fio ?></h3>
                            <?= $form->field($child, 'file_personal_form['.$child->id.']', [
                                'template' => getFileInputTemplate($child->file_personal, $child->attributeLabels()['file_personal']. '.pdf'),
                            ])->fileInput(['class' => 'custom-file-input']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="card card-solid card-secondary  ">
    <div class="card-body">
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2">
                <?php
                    if ($model->id) {
                        echo Html::submitButton(
                            Icon::show('save') . 'Сохранить заявку',
                            [
                                'class' => 'btn btn-success float-right',
                                'id' => 'btn-save',
                                'value' => 1,
                                'name' => 'save',
                            ]
                        );
                    }
                ?>
            </div>
        </div>
    </div>
</div>
