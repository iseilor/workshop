<?php

use app\modules\jk\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Faq */

$this->title = '<i class="fas fa-plus"></i> ' . Module::t('module', 'Create Faq');
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = ['label' => '<i class="fas fa-question"></i> ' . Module::t('module', 'Faqs'), 'url' => ['admin']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-create">
    <?= $this->render(
        '_form',
        [
            'model' => $model,
        ]
    ) ?>
</div>