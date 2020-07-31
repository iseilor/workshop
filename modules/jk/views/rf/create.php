<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Rf */

$this->title = Icon::show('plus').Module::t('rf', 'Create Rf');
$this->params['breadcrumbs'][] = ['label' => Icon::show('sitemap').Module::t('rf', 'RFs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rf-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
