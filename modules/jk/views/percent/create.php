<?php

/* @var $this yii\web\View */

/* @var $model app\modules\jk\models\Percent */
/* @var $mins app\modules\jk\models\Min */

use app\modules\jk\Module;
use kartik\icons\Icon;

$this->title = Icon::show('calculator').Module::t('percent','Calculator Percent');
$this->params['breadcrumbs'][] = ['label' => '<i class="nav-icon fas fa-home"></i> Жилищная Программа', 'url' => ['/jk']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render(
    '_form',
    [
        'model' => $model
    ]
) ?>