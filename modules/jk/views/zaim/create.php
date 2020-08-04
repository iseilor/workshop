<?php

use app\modules\jk\Module;
use kartik\icons\Icon;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $model app\modules\jk\models\Min */

$this->title =Icon::show('calculator').Module::t('zaim','Calculator Zaim');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK') , 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_form', [
    'model' => $model,
    'mins' => $mins
]) ?>