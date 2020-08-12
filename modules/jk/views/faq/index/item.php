<?php

use app\modules\jk\models\Faq;
use yii\helpers\Html;

?>
<div class="card card-primary">
    <div class="card-header">
        <h4 class="card-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#faq-<?= $faq->id ?>"
               class="collapsed" aria-expanded="false">
                <i class='fas fa-question'></i> <?= Html::encode($faq->question) ?>
            </a>
        </h4>
    </div>
    <div id="faq-<?= $faq->id ?>" class="panel-collapse collapse">
        <div class="card-body">

            <?php
            // Получаем дочерние вопросы
            $faqs = Faq::find()->where('faq_id=' . $faq->id)->all();
            foreach ($faqs as $faq) {
                echo $this->render('subitem', ['faq' => $faq]);
            }
            ?>
        </div>
    </div>
</div>

