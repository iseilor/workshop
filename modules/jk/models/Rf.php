<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;

/**
 * This is the model class for table "jk_rf".
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
 * @property int $user_id
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property float $coefficient
 * @property float $percent_max
 * @property float $loan_max
 */
class Rf extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_rf';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'user_id', 'email', 'phone', 'address', 'coefficient', 'percent_max', 'loan_max'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['coefficient', 'percent_max', 'loan_max'], 'number'],
            [['title', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('rf', 'ID'),
            'created_at' => Module::t('rf', 'Created At'),
            'created_by' => Module::t('rf', 'Created By'),
            'updated_at' => Module::t('rf', 'Updated At'),
            'updated_by' => Module::t('rf', 'Updated By'),
            'deleted_at' => Module::t('rf', 'Deleted At'),
            'deleted_by' => Module::t('rf', 'Deleted By'),
            'title' => Module::t('rf', 'Title'),
            'description' => Module::t('rf', 'Description'),
            'user_id' => Module::t('rf', 'User ID'),
            'email' => Module::t('rf', 'Email'),
            'phone' => Module::t('rf', 'Phone'),
            'address' => Module::t('rf', 'Address'),
            'coefficient' => Module::t('rf', 'Coefficient'),
            'percent_max' => Module::t('rf', 'Percent Max'),
            'loan_max' => Module::t('rf', 'Loan Max'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RfQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RfQuery(get_called_class());
    }
}
