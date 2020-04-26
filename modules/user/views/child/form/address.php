<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= $form->field($model, 'address_registration')->textarea() ?>

<?= $form->field($model, 'registration_file_form', [
    'template' => getFileInputTemplate($model->registration_file,  'Свидетельство о регистрации.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>

<?= $form->field($model, 'address_mother_file_form', [
    'template' => getFileInputTemplate($model->address_mother_file,  'Заявление от матери.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR])
        . 'Образец заявления', Url::to('/files/child/0-examples/example_child_address_mother.pdf', true), ['target' => '_blank'])) ?>

<?= $form->field($model, 'address_father_file_form', [
    'template' => getFileInputTemplate($model->address_father_file, 'Заявление от отца.pdf'),
])->fileInput(['class' => 'custom-file-input'])->hint('Заявление составляются полностью от руки. 
    Если в свидетельстве у ребёнка не указан отец, то заявление от папы не нужно. '
    . Html::a(Icon::show('file-pdf', ['framework' => Icon::FAR]) . 'Образец заявления', Url::to('/files/child/0-examples/example_child_address_father.pdf', true), ['target' => '_blank'])) ?>

<?= $form->field($model, 'ejd_file_form', [
    'template' => getFileInputTemplate($model->ejd_file, $model->attributeLabels()['ejd_file'] . '.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>