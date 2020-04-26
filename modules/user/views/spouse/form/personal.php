<?php

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<blockquote>
    <p>
        Заполните все поля формы по вашей(ему) супруге(у). Проверьте введённые данные и нажмите кнопку
        <?=Html::tag('span',Icon::show('save').'Сохранить',['class'=>"badge bg-success"])?>.
        После этого повторно откройте форму регистрации данных по супруге(у) и скачайте автоматически
        сформированный бланк, который нужно будет распечатать, подписать и прикрепить в поле ниже<br/>
        <?= Html::a(Icon::show('file-pdf') . 'Согласие на обработку персональных данных по супруге(у)',
            Url::to(['/user/spouse/' . $model->id . '/pd'])) ?>
    </p>
</blockquote>
<?= $form->field($model, 'personal_data_file_form', [
    'template' => getFileInputTemplate($model->personal_data_file,  $model->attributeLabels()['personal_data_file'].'.pdf'),
])->fileInput(['class' => 'custom-file-input']) ?>
