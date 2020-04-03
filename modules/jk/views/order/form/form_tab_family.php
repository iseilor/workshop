<?php
/* @var $userChildDataProvider \yii\data\ActiveDataProvider */

$isSpouseClass = 'hide';
if (isset($model->is_spouse) && $model->is_spouse == 1) {
    $isSpouseClass = '';
}
$isChildClass = 'hide';
if (isset($model->child_count) && $model->child_count > 0) {
    $isChildClass = '';
}

use app\components\grid\ActionColumn;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\widgets\MaskedInput; ?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'is_spouse')->dropDownList(['1' => 'Да', '0' => 'Нет', '2' => 'Разведён(а)'], ['prompt' => 'Выберите из списка']); ?>
        <?= $form->field($model, 'spouse_fio', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'spouse_is_dzo', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
            ['1' => 'Да', '0' => 'Нет'],
            ['prompt' => 'Выберите из списка']
        ); ?>
        <?= $form->field($model, 'spouse_is_do', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
            ['1' => 'Да', '0' => 'Нет'],
            ['prompt' => 'Выберите из списка']
        ); ?>
        <?= $form->field($model, 'spouse_is_work', ['options' => ['class' => 'form-group is-spouse ' . $isSpouseClass]])->dropDownList(
            ['1' => 'Да', '0' => 'Нет'],
            ['prompt' => 'Выберите из списка']
        ); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'child_count')->widget(MaskedInput::className(), ['mask' => '9']) ?>
        <?= $form->field($model, 'child_count_18', ['options' => ['class' => 'form-group is-child ' . $isChildClass]])->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'child_count_23', ['options' => ['class' => 'form-group is-child ' . $isChildClass]])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
        <div class="form-group is-child <?= $isChildClass ?>">
            <label class="control-label" for="order-child_count">Дети</label>
            <div class="help-block">* Вся таблица по кол-ву детей должна быть заполнена</div>
            <?= GridView::widget(
                [
                    'dataProvider' => $userChildDataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'fio',
                        'date:date',
                        [
                            'class' => ActionColumn::className(),
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return '<button type="button" class="btn btn-danger btn-xs">' . Icon::show('trash') . '</button>';
                                },
                            ],
                        ],
                    ],
                ]
            ); ?>
            <button type="button" class="btn btn-success btn-xs"><?= Icon::show('baby') ?> Добавить ребёнка</button>
        </div>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'family_own')->textarea(); ?>
        <?= $form->field($model, 'family_rent')->textarea(); ?>
        <?= $form->field($model, 'family_address')->textarea(); ?>
        <?= $form->field($model, 'family_deal')->textarea(); ?>
    </div>
</div>