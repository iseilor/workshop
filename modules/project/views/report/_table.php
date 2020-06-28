<table class="table table-bordered">
    <thead>
    <tr>
        <th>Дата</th>
        <th>ФИО</th>
        <th>Комментарий</th>
        <th>Статус</th>
        <th>Прогресс</th>
        <th>RFC</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $projectTitlePrev='';
    ?>
    <? foreach ($tasks as $task): ?>
        <?php
        $projectTitle = $task->project->title;
        if ($projectTitle!=$projectTitlePrev){
            $projectTitlePrev = $projectTitle;
            echo "<tr>
                                    <td colspan='7'><h1>$projectTitle</h1></td>
                                </tr>";
        }

        ?>
        <tr class="<?=($task->status_id==4)?'table-danger':'';?>">

            <td><?= Yii::$app->formatter->asDatetime($task->created_at) ?></td>
            <td><?=$task->createdUserLink?></td>
            <td><?=$task->comment?></td>
            <td><?=$task->status->label?></td>
            <td><?=$task->getProgressBar()?></td>
            <td><?=$task->rfc?></td>
        </tr>
    <? endforeach; ?>
    </tbody>
</table>