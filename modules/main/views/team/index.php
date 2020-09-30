<?php

use app\modules\main\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '<i class="fas fa-users"></i>' . ' ' . Module::t('module', 'Команда проекта');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'index_item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row d-flex align-items-stretch',
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-12 col-sm-6 col-md-4 d-flex align-items-stretch',
        ],
    ]
);
?>

