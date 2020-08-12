<?php

use app\modules\jk\models\Faq;
use app\modules\jk\Module;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */

$this->title = Icon::show('plus') . Module::t('faq', 'Create Faq');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => Icon::show('question') . Module::t('faq', 'FAQ'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">
    <?php
    // Автоматически вычисляем максимальный вес для следующего вопроса
    $weight = Faq::find()->max('weight');
    $model->weight=$weight+1;
    echo $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>
</div>