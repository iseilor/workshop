<?php
/* @var $items Array */

/* @var $imgs Array */

use app\modules\kr\Module;
use kartik\icons\Icon;
use yii\widgets\ListView;

$this->title = Icon::show(Module::getIcon()) . Module::t('module', 'kr');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="row d-flex align-items-stretch">
        <?php
        foreach ($imgs as $img) {
            echo $this->render(
                'index_item_img',
                [
                    'item' => $img,
                ]
            );
        }
        ?>
    </div>
<?php
echo ListView::widget(
    [
        'dataProvider' => $dataProvider,
        'itemView' => 'item',
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