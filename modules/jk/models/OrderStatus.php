<?php

namespace app\modules\jk\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "jk_order_status".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $title_long
 * @property int|null $progress
 * @property string|null $color
 * @property string|null $description
 */
class OrderStatus extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'title','title_long','icon'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'progress'], 'integer'],
            [['description'], 'string'],
            [['title', 'color','long','icon'], 'string', 'max' => 255],
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
            'progress' => Yii::t('app', 'Progress'),
            'color' => Yii::t('app', 'Color'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderStatusQuery(get_called_class());
    }


    /**
     * Получить плашку текущего статуса
     * @return string
     */
    public function getStatusLabel(){
        return '<span class="badge bg-'.$this->color.'" title="'.$this->description.'">'.$this->title.'</span>';
    }

    // TODO: Все перенести из функции выше в эту функцию
    public function getLabel(){
        return '<span class="badge bg-'.$this->color.'" title="'.$this->description.'">'.$this->title.'</span>';
    }


    /**
     * Получить progressbar текущего статуса
     * @return string
     */
    public function getProgressBar(){
        return '<div class="progress progress-sm" title="'.$this->description.'">
                    <div class="progress-bar bg-'.$this->color.'" role="progressbar" aria-volumenow="' . $this->progress . '" aria-volumemin="0" aria-volumemax="100" style="width: ' . $this->progress . '%"></div>
                </div>
                <small>' . $this->progress . '% выполнено</small>';
    }
}
