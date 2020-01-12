<?php

use yii\widgets\DetailView;
$this->title = $model->username;

?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username'
    ],
]) ?>