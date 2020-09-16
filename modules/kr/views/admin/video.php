<?php use app\modules\video\models\VideoSearch;
use yii\widgets\ListView;

$searchModel = new VideoSearch();
$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
$dataProvider->query->andWhere(['module_id'=>'kr']);


echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '@app/modules/video/views/video/_item.php',
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
]);

