<?php

namespace app\modules\main\models;

use app\modules\main\Module;
use Yii;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $name
 * @property string $full_name
 * @property string $filial
 * @property string $position
 * @property string $department
 * @property string $email
 * @property string $phone
 * @property int $birth
 * @property string $adress
 * @property string $photo
 * @property string $about
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'created_by', 'name', 'full_name', 'filial', 'position', 'department', 'email', 'phone', 'birth', 'adress', 'photo', 'about'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'birth'], 'integer'],
            [['about'], 'string'],
            [['name', 'full_name', 'filial', 'position', 'department', 'email', 'phone', 'adress', 'photo'], 'string', 'max' => 255],
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
            'name' => Module::t('module', 'Name'),
            'full_name' => Module::t('module', 'Full Name'),
            'filial' => Module::t('module', 'Filial'),
            'position' => Module::t('module', 'Position'),
            'department' => Module::t('module', 'Department'),
            'email' => Module::t('module', 'Email'),
            'phone' => Module::t('module', 'Phone'),
            'birth' => Module::t('module', 'Birth'),
            'address' => Module::t('module', 'Address'),
            'photo' => Module::t('module', 'Photo'),
            'about' => Module::t('module', 'About'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return TeamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TeamQuery(get_called_class());
    }
}
