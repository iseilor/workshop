<?php

use app\components\grid\LinkColumn;
use app\modules\kr\models\Block;
use app\modules\kr\Module;
use kartik\export\ExportMenu;
use kartik\icons\Icon;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('users') . Module::t('student', 'Students');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users') . Module::t('module', 'kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title"><?= $this->title ?></h3>
        <?= Yii::$app->params['card']['header']['tools'] ?>
    </div>

    <div class="card-body">


        <?php

        $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            'user.photoFioLabel:html',
            'total',
            [
                'filter' => ArrayHelper::map(Block::find()->all(), 'id', 'title'),
                'attribute' => 'blockTitle',
                'value' => 'block.badge',
                'format' => 'html',
            ],

        ];
        echo ExportMenu::widget(
            [
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
            ]
        );

        Pjax::begin(['timeout' => false]);
        echo \kartik\grid\GridView::widget(
            [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $gridColumns,
                'tableOptions' => [
                    'class' => 'table table-striped projects',
                    'style' => 'margin-bottom: 0',
                ],
                'pager' => [
                    'class' => 'app\widgets\LinkPager',
                ],
            ]
        );
        Pjax::end();
        ?>


    </div>
</div>