<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jk_faq".
 *
 * @property int         $id
 * @property string      $created_at
 * @property int         $created_by
 * @property string|null $updated_at
 * @property int|null    $updated_by
 * @property string      $question
 * @property string      $answer
 * @property int|null    $weight
 * @property int|null    $faq_id
 */
class Faq extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weight'], 'required'],
            [['weight', 'faq_id'], 'integer'],
            [['answer', 'question'], 'string'],
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
                'question' => Module::t('faq', 'Question'),
                'answer' => Module::t('faq', 'Answer'),
                'faq_id' => Module::t('faq', 'Faq Id'),
                'weight' => Module::t('faq', 'Weight'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return Faq2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new FaqQuery(get_called_class());
    }

    // Родительский вопрос
    public function getParent()
    {
        return $this->hasOne(Faq::class, ['id' => 'faq_id']);
    }
}