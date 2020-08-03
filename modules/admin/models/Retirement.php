<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "retirement".
 *
 * @property int $id
 * @property int $age
 * @property string $gender
 */
class Retirement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'retirement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age', 'gender'], 'required'],
            [['age'], 'integer'],
            [['gender'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'age' => Yii::t('app', 'Age'),
            'gender' => Yii::t('app', 'Gender'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MrfQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RetirementQuery(get_called_class());
    }
}
