<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\jk\models\Zaim */
/* @var $min app\modules\jk\models\Min */

$this->title = Icon::show('calculator').Module::t('zaim', 'Update Zaim: {name}', ['name' => $model->id]);
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk']];
$this->params['breadcrumbs'][] = Module::t('calculator', 'Calculator').' №'.$model->id;
?>

<?= $this->render(
    '_form',
    [
        'model' => $model,
        'mins' => $mins
    ]
) ?>