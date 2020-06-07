<?php

use app\components\grid\ActionColumn;
use app\components\grid\LinkColumn;
use app\modules\user\models\Child;
use app\modules\user\Module;
use kartik\icons\Icon;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\ChildSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Icon::show('baby') . Module::t('child', 'My Children');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title; ?></h3>
                <?= Yii::$app->params['card']['header']['tools'] ?>
            </div>
            <div class="card-body">
                <?php
                use app\modules\user\models\ChildSearch;

                $searchModel = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
                $dataProvider = $searchModel->search([]);
                $dataProvider->query->andWhere(['deleted_at' => null]);

                echo $this->render('@app/modules/user/views/child/grid-view', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);?>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
