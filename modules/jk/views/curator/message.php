<?php
/**
 * @property \app\modules\chat\models\Chat $model
 */

use yii\helpers\Html;

?>
<div class="direct-chat-msg <?= (!$model->is_curator) ? 'right' : '' ?>">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name <?= (!$model->is_curator) ? 'float-right' : 'float-left' ?>">
            <?= $model->createdUser->fio ?>
        </span>
        <span class="direct-chat-timestamp <?= ($model->is_curator) ? 'float-left' : 'float-right' ?>">
            <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
        </span>
    </div>
    <?= Html::img($model->createdUser->photoPath, ['class' => 'direct-chat-img']) ?>
    <div class="direct-chat-text">
        <?= $model->message ?>
    </div>
</div>