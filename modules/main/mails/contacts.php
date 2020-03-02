<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<p>
    На портале <?php echo Html::a(Yii::$app->name, 'http://'.$_SERVER['SERVER_NAME'].Url::home()); ?>
    пользователь <strong><?=$contactForm->fio;?></strong>
    (<a href="mailto:<?=$contactForm->email;?>"><?=$contactForm->email;?></a>)
    оставил следующее сообщение:
</p>
<ul>
    <li><strong>Тема сообщение:</strong> <?=$contactForm->subject?></li>
    <li><strong>Текст сообщения:</strong> <?=$contactForm->body?></li>
</ul>
<p>Необходимо как можно быстрее связаться с пользователем и ответить на все интересующие его вопросы.</p>