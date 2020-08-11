<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;

/**
 * This is the model class for table "jk_faq2".
 *
 * @property int $id
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string $question
 * @property string $answer
 */
class Faq2 extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_faq2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'answer','weight'], 'required'],
            [['created_at', 'updated_at','faq_id'], 'safe'],
            [['weight','faq_id'], 'integer'],
            [['answer'], 'string'],
            [['question'], 'string', 'max' => 255],
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

            'question' => Module::t('faq', 'Question'),
            'answer' => Module::t('faq', 'Answer'),
            'weight' => Module::t('faq', 'Weight'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return Faq2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new Faq2Query(get_called_class());
    }
}
