<?php

namespace app\modules\kr\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "kr_curator".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $fio
 * @property string $position
 * @property string $description
 * @property string $phone
 * @property string $email
 * @property string $img
 * @property int $weight
 * @property int $block_id
 */
class Curator extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kr_curator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'position', 'description', 'phone', 'email', 'img', 'weight', 'block_id'], 'required'],
            [['weight', 'block_id'], 'integer'],
            [['description', 'email'], 'string'],
            [['fio', 'position', 'phone', 'img'], 'string', 'max' => 255],
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
            'fio' => Yii::t('app', 'Fio'),
            'position' => Yii::t('app', 'Position'),
            'description' => Yii::t('app', 'Description'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'img' => Yii::t('app', 'Img'),
            'weight' => Yii::t('app', 'Weight'),
            'block_id' => Yii::t('app', 'Block ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CuratorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CuratorQuery(get_called_class());
    }
}
