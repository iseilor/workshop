<?php

use app\modules\main\Module;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\main\models\TeamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = '<i class="fas fa-users"></i>'.' '.Module::t('module', 'Teams');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-solid">
    <div class="card-body pb-0">
            <?php echo ListView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'itemView' => 'index_item',
                    'layout' => "{items}",
                    'options' => [
                        'tag' => 'div',
                        'class' => 'row d-flex align-items-stretch'
                    ],
                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'col-12 col-sm-6 col-md-4 d-flex align-items-stretch',
                    ],
                ]
            );
            ?>
    </div>
    <div class="card-footer">
        <a class="btn btn-success" href="#">Вступить в команду</a>
        <a class="btn btn-success" href="#">Помочь команде</a>
        <!--<nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">4</a></li>
                <li class="page-item"><a class="page-link" href="#">5</a></li>
                <li class="page-item"><a class="page-link" href="#">6</a></li>
                <li class="page-item"><a class="page-link" href="#">7</a></li>
                <li class="page-item"><a class="page-link" href="#">8</a></li>
            </ul>
        </nav>-->
    </div>
</div>
