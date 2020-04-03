<?php

use yii\widgets\DetailView;

?>



<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => $model->attributeLabels()['ipoteka_target'],
            'value' => $model::getIpotekaTargetName($model->ipoteka_target),
        ],
        'ipoteka_size:currency',
        'ipoteka_user:currency',
        'ipoteka_params:ntext',
        'ipoteka_summa:ntext'
    ],
]) ?>