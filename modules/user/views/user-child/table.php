<?php
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\form\ActiveForm;

use kartik\builder\TabularForm;
use kartik\grid\GridView;
use kartik\helpers\Html;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin();
echo TabularForm::widget([

                             'form' => $form,
                             'dataProvider' => $dataProvider,
                             'attributes' => [
                                 'fio' => ['type' => TabularForm::INPUT_TEXT]


                             ],
                             'gridSettings' => [
                                 'floatHeader' => true,
                                 'panel' => [
                                     'heading' => '<i class="fas fa-book"></i> Manage Books',
                                     'type' => GridView::TYPE_PRIMARY,
                                     'after'=>
                                         Html::a(
                                             '<i class="fas fa-plus"></i> Add New',
                                             12,
                                             ['class'=>'btn btn-success']
                                         ) . '&nbsp;' .
                                         Html::a(
                                             '<i class="fas fa-times"></i> Delete',
                                             12,
                                             ['class'=>'btn btn-danger']
                                         ) . '&nbsp;' .
                                         Html::submitButton(
                                             '<i class="fas fa-save"></i> Save',
                                             ['class'=>'btn btn-primary']
                                         )
                                 ]
                             ]
                         ]);
ActiveForm::end();