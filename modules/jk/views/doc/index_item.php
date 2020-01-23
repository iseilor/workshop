<?php

use yii\helpers\Html;

?>

<div class="info-box">
    <?php

    // Иконка для имени файла
    $fileIcon = 'file';
    if (isset($model->src)){
        $file = explode('.', $model->src);
        $file = end($file);
        if ($file!=''){
            switch ($file) {
                case 'docx':
                case 'doc':
                    $fileIcon = 'file-word';
                    break;
                case 'xls':
                case 'xlsx':
                    $fileIcon = 'file-excel';
                    break;
                case 'pdf':
                    $fileIcon = 'file-pdf';
                    break;
                case 'txt':
                    $fileIcon = 'file-alt';
                    break;
            }
        }
    }
    ?>

    <?= Html::a(
        '<i class="fas fa-'.$fileIcon.'"></i>',
        [Yii::$app->homeUrl . Yii::$app->params['module']['jk']['doc']['filePath'] . $model->src],
        [
            'class' => 'info-box-icon bg-info elevation-1',
            'target' => '_blank'
        ]
    ) ?>
    <div class="info-box-content">
        <span class="info-box-text" style="white-space: normal;"><?= $model->title ?></span>
        <span class="info-box-number">
            <?= Html::a('Скачать', ['/'.Yii::$app->params['module']['jk']['doc']['filePath'] . $model->src], ['target' => '_blank']) ?>
        </span>
    </div>
</div>
