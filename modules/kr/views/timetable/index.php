<?php

use app\modules\kr\models\BlockSearch;
use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\kr\models\TimetableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('list') . Module::t('timetable', 'Timetables');
$this->params['breadcrumbs'][] = ['label' => Icon::show('users') . Module::t('module', 'kr'), 'url' => ['/kr/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card">
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout'=> "{items}",
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                'date',
                [
                    'attribute' => 'title',
                    'content'=>function($data){
                        $link= (isset($data->link) && $data->link) ?
                            Html::a("Ссылка на трансляцию"."&nbsp;" . Icon::show('external-link-alt'),
                                $data->link, ['target' => '_blank'])
                            : '';
                        $qr= (isset($data->link) && $data->link) ?
                            $this->render('_qr', ['model' => $data])
                            : '';
                        return$data->title.'<br/>'.$link.'<br/>'.$qr;
                    }
                ],
                'curator:ntext',
                'groups',
                [
                    'label' => 'Подробнее',
                    'content'=>function($data){
                        return (isset($data->description) && $data->description) ?
                             $this->render('_modal', ['model' => $data]) : '';
                    }
                ],
            ],
        ]); ?>
        <?php Pjax::end(); ?>

        <p>* Подробная информация о датах обучения указана на странице вашего сегмента.</p>
        <?php

        $blockSearchModel = new BlockSearch();
        $blockDataProvider = $blockSearchModel->search(Yii::$app->request->queryParams);
        $blockDataProvider->setSort(['defaultOrder' => ['weight' => SORT_ASC]]);
        echo ListView::widget(
            [
                'dataProvider' => $blockDataProvider,
                'itemView' => '../default/item',
                'layout' => "{items}",
                'options' => [
                    'tag' => 'div',
                    'class' => 'row d-flex align-items-stretch',
                ],
                'itemOptions' => [
                    'tag' => 'div',
                    'class' => 'col-md-3',
                ],
            ]
        );
        ?>
    </div>
</div>
