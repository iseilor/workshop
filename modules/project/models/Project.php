<?php

namespace app\modules\project\models;

use app\models\Model;
use app\modules\project\Module;
use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $description
 * @property string|null $img
 * @property string|null $users
 * @property int|null $status_id
 * @property int|null $progress
 */
class Project extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['status_id', 'progress'], 'integer'],
            [['description'], 'string'],
            [['title', 'img', 'users'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),

            'users' => Module::t('project', 'Users'),
            'status_id' => Yii::t('app', 'Status ID'),
            'progress' => Yii::t('app', 'Progress'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectQuery(get_called_class());
    }
}
