<?php

namespace app\modules\video\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $title
 * @property string   $description
 * @property string   $img
 * @property string   $video
 * @property string   $module_id
 * @property string   $category_id
 * @property int|null $view
 * @property int|null $like
 * @property int      $weight
 */
class Video extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'img', 'video', 'module_id', 'category_id','weight'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'view', 'like','weight'], 'integer'],
            [['description'], 'string'],
            [['title', 'img', 'video', 'module_id', 'category_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
            'video' => Yii::t('app', 'Video'),
            'module_id' => Yii::t('app', 'Module ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'view' => Yii::t('app', 'View'),
            'like' => Yii::t('app', 'Like'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoQuery(get_called_class());
    }
}
