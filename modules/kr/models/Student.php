<?php

namespace app\modules\kr\models;

use app\models\Model;
use app\modules\kr\Module;
use app\modules\user\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kr_student".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $user_id
 * @property int $block_id
 * @property string $total
 * @property string $description
 * @property int $weight
 */
class Student extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kr_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'block_id', 'total', 'description', 'weight'], 'required'],
            [['block_id', 'weight'], 'integer'],
            [['description'], 'string'],
            [['user_id', 'total'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'created_at'=>Module::t('student', 'Created At'),
                'user_id' => Module::t('student', 'User ID'),
                'user.photoFioLabel'=>Module::t('student', 'User ID'),
                'block_id' => Module::t('student', 'Block ID'),
                'blockTitle' => Module::t('student', 'Block ID'),
                'total' => Module::t('student', 'Total'),
                'description' => Module::t('student', 'Description'),
                'weight' => Module::t('student', 'Weight'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentQuery(get_called_class());
    }

    // Максимальный вес для сотрировки
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }

    // Блок обучения
    public function getBlock()
    {
        return $this->hasOne(Block::class, ['id' => 'block_id']);
    }

    public function getBlockTitle(){
        return $this->block->title;
    }

    // Участник программы
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
