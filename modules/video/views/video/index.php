<?php

use app\modules\video\Module;
use kartik\icons\Icon;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\video\models\VideoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('youtube', ['framework' => Icon::FAB]) . Module::t('module', 'Video Instruction');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').\app\modules\jk\Module::t('module','JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_item',
    'layout' => "{items}\n{pager}",
    'options' => [
        'tag' => 'div',
        'class' => 'row',
        'id' => 'video-list',
    ],
    'itemOptions' => [
        'tag' => 'div',
        'class' => 'col-3',
    ],
]); ?>