<?php

use app\modules\project\Module;

use kartik\icons\Icon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\project\models\TaskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $task  app\modules\project\models\Task */
/* @var $tasks  app\modules\project\models\Task */

$this->title = Module::t('report', 'Report');
$this->params['breadcrumbs'][] = ['label' => Module::t('project', 'Projects'), 'url' => ['/project']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-task-index">
    <?php Pjax::begin(['timeout' => 0]); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?=Icon::show('table')?>
                Сводный отчёт по выполненным задачам за <?=$searchModel->date_start?> 00:00:00 - <?=$searchModel->date_end?> 23:59:59</h3>
            <?= Yii::$app->params['card']['header']['tools'] ?>
        </div>
        <div class="card-body">
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
                                    <td colspan='7'><h3>$projectTitle</h3></td>
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
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success"><?=Icon::show('envelope');?>Отправить на email</button>
            <button type="submit" class="btn btn-primary"><?=Icon::show('file-word');?>Сохранить в DOCX</button>
            <button type="submit" class="btn btn-primary"><?=Icon::show('file-pdf');?>Сохранить в PDF</button>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>