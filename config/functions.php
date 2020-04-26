<?php


use kartik\icons\Icon;
use yii\helpers\Html;
use yii\helpers\Url;

function mb_ucfirst($string, $encoding = 'UTF-8')
{
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    return mb_strtoupper($firstChar, $encoding) . $then;
}

// Шаблон для поля загрузки файлов
function getFileInputTemplate($file, $fileName)
{
    if (!$file) {
        $fileName = '';
    }
    return '{label}
        <div class="input-group">
            <div class="custom-file">
                {input}
                <label class="custom-file-label" for="exampleInputFile">' . $fileName . '</label>
            </div>
        </div>
        {error}{hint}';
}

// Отображение полей с файлами во View
function viewFieldFile($model, $field, $url)
{
    $i = 10;
    return [
        'label' => $model->attributeLabels()[$field],
        'format' => 'raw',
        'value' => ($model->{$field}) ? Html::a(
            Icon::show('file-pdf') . $model->attributeLabels()[$field],
            Url::to($url, true),
            ['target' => '_blank']) : '',
    ];
}