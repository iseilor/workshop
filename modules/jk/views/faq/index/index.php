<?php

use app\modules\jk\Module;
use kartik\icons\Icon;


$this->title = Icon::show('question').Module::t('faq','FAQ');
$this->params['breadcrumbs'][] = ['label' => Icon::show('home').Module::t('module','JK'), 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;


\app\modules\jk\assets\JkFaqAsset::register($this);

?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-info"></i> Информация</h5>
                    Чтобы получить ответ на часто задаваемый вопрос, необходимо нажать на него мышкой
                </div>
                <div id="accordion">
                    <?php
                        foreach ($faqs as $faq) {
                            echo $this->render('item', ['faq' => $faq]);
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

