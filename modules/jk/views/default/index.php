<?php

use app\modules\jk\Module;
use kartik\icons\Icon;
use yii\helpers\Url;

/* @var $this yii\web\View */
$icon = Icon::show('home');
$this->title = $icon . Module::t('module', 'jk');
$this->params['breadcrumbs'][] = $icon . Module::t('module', 'JK');;
?>

<div class="alert alert-default-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-info"></i> Информация!</h5>
    <ul>
        <li>Если у вас уже <u>есть кредит в банке</u>, и вы бы хотели по нему рассчитать компенсацию
            процентов, то используете <a class="btn bg-primary btn-xs btn-a"
                                         href="<?= Url::to(['/jk/percent/create']); ?>"><i
                        class="fas fa-calculator"></i>
                Калькулятор процентов</a></li>

        <li>Если вы только <u>планируете взять кредит в банке</u> и рассчитываете на помощь со стороны
            компании, то используете <a class="btn bg-primary btn-xs btn-a"
                                        href="<?= Url::to(['/jk/zaim/create']); ?>"><i
                        class="fas fa-calculator"></i>
                Калькулятор займа</a>
        </li>
        <li>
            Примеры бланков заявлений и другую нормативную документацию вы можете найти в разделе
            с <a class="workshop-link"
                 href="<?= Url::to(['/jk/doc']); ?>">
                документами</a>
        </li>
        <li>
            Ответы на часто возникающие вопросы ищете в разделе с <a class="workshop-link"
                                                                     href="<?= Url::to
                                                                     (
                                                                         ['/jk/faq']
                                                                     ); ?>">вопросами</a>
        </li>

    </ul>
</div>

<div class="row">
    <?php
    foreach ($items as $item) {
        echo $this->render('index_item', ['item' => $item]);
    } ?>
</div>