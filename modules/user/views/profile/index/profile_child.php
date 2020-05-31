<?php

use app\modules\user\models\ChildSearch;

$searchModel = new ChildSearch(['user_id' => Yii::$app->user->identity->id]);
$dataProvider = $searchModel->search([]);
echo $this->render('@app/modules/user/views/child/grid-view', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
]);