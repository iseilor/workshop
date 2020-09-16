<?php
/* @var $items Array */
/* @var $imgs Array */

use app\modules\kr\Module;
use kartik\icons\Icon;

$this->title = Icon::show(Module::getIcon()).Module::t('module', 'kr');
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
<div class="row">
    <?php
    foreach ($items as $item) {
        echo $this->render(
            'index_item',
            [
                'item' => $item,
            ]
        );
    }
    ?>
</div>