<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user app\modules\user\models\User */
/* @var $usersNotVoted app\modules\user\models\User */
?>
<p>
    <strong>Уважаемый, <?= $user->fio ?>!</strong>
<p>
<p>
    Результаты мониторинга по вашему подразделению (Отдел эксплуатации систем поддержки операций) за <strong><?= date('d.m.Y') ?></strong>
</p>

<h1>Общая статистика</h1>
<ul>
    <li><strong>Индекс здоровья</strong>: <?=$data['health']['today']?> (<?=$data['health']['diff'];?>)</li>
    <li><strong>Индекс настроения</strong>: <?=$data['mood']['today']?> (<?=$data['mood']['diff'];?>)</li>
    <li><strong>Индекс работоспособности</strong>: <?=$data['job']['today']?> (<?=$data['job']['diff'];?>)</li>
</ul>
<p>Статистика за неделю (месяц) на портале http://workshop/pulsar</p>

<?php if (count($usersNotVoted) > 0): ?>
    <h1>Неотметившиеся сотрудники (<span style="background-color: red;color: white; border-radius: 5px;"> <?= count($usersNotVoted) ?> </span>)</h1>
    <ol>
        <?php foreach ($usersNotVoted as $key => $user): ?>
            <li><?= $user['fio'] ?></li>
        <?php endforeach; ?>
    </ol>
<?php endif; ?>

<p>
    Более детально информацию по своему подразделению вы можете посмотреть на портале
    http://workshop/pulsar/table
</p>

<p>
    Письмо сформировано автоматически и не требует ответа. По всем возникающим вопросам и пожеланиям по работе с системой
    пишите администрации портала по адресу <?= Html::a('workshop@rt.ru', 'mailto:workshop@rt.ru') ?>.
    Крепкого вам здоровья и хорошего настроения.<br/>
</p>
<p>
    <strong>С уважением Администрация HR-портала</strong>
</p>