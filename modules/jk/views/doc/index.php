<?php

$this->title = "Документы";
$this->params['breadcrumbs'][] = ['label' => 'Жилищная компания', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;

use yii\widgets\ListView; ?>

<?php

echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'index_item',
        'layout' => "{items}",
        'options' => [
            'tag' => 'div',
            'class' => 'row'
        ],
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'col-md-6',
        ],
    ]
);
?>


