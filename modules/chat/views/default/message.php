<?php
/**
 * @property \app\modules\chat\models\Chat $model
 */

use yii\helpers\Html;

?>
<div class="direct-chat-msg <?= (Yii::$app->user->identity->id == $model->created_by) ? 'right' : '' ?>">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name <?= (Yii::$app->user->identity->id == $model->created_by) ? 'float-right' : 'float-left' ?>">
            <?= $model->createdUser->fio ?>
        </span>
        <span class="direct-chat-timestamp <?= (Yii::$app->user->identity->id == $model->created_by) ? 'float-left' : 'float-right' ?>">
            <?= Yii::$app->formatter->asDatetime($model->created_at) ?>
        </span>
    </div>
    <?= Html::img($model->createdUser->photoPath, ['class' => 'direct-chat-img']) ?>
    <div class="direct-chat-text">
        <?= $model->message ?>
    </div>
</div>