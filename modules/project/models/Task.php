<?php

namespace app\modules\project\models;

use app\models\Model;
use app\modules\project\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "project_task".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $comment
 * @property int|null $user_id
 * @property int|null $project_id
 * @property string|null $img
 * @property int $status_id
 * @property int|null $progress
 */
class Task extends Model
{
    public $created;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'comment', 'status_id'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id', 'project_id', 'status_id', 'progress','rfc'], 'integer'],
            [['comment'], 'string'],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'created'=>Module::t('task', 'Created'),
            'comment' => Yii::t('app', 'Comment'),
            'user_id' => Yii::t('app', 'User ID'),
            'project_id' => Module::t('task', 'Project Id'),
            'img' => Yii::t('app', 'Img'),
            'status_id' => Module::t('task', 'Status Id'),
            'progress' => Yii::t('app', 'Progress'),
            'rfc'=>Module::t('task', 'RFC'),

            'date_start'=>Module::t('task', 'Date Start'),
            'date_end'=>Module::t('task', 'Date End'),
        ]);
    }

    /**
     * {@inheritdoc}
     * @return TaskQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskQuery(get_called_class());
    }

    public function getStatus(){
        return $this->hasOne(TaskStatus::class, ['id' => 'status_id']);
    }

    public function getProject(){
        return $this->hasOne(Project::class, ['id' => 'project_id']);
    }

    /**
     * Получить progressbar текущей задачи
     * @return string
     */
    public function getProgressBar(){
        return '<div class="progress progress-sm" title="'.$this->status->title.'">
                    <div class="progress-bar bg-'.$this->status->color.'" role="progressbar" aria-volumenow="' . $this->progress . '" aria-volumemin="0" aria-volumemax="100" style="width: ' . $this->progress . '%"></div>
                </div>
                <small>' . $this->progress . '% выполнено</small>';
    }
}