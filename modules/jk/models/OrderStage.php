<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jk_order_stage".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $order_id
 * @property int      $status_id
 * @property string   $comment
 */
class OrderStage extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order_stage';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'status_id', 'comment'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'status_id', 'order_id'], 'integer'],
            [['comment'], 'string', 'max' => 255],
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
                'created_by' => Module::t('order_stage', 'Created By'),
                'order_id' => Module::t('order_stage', 'Order ID'),
                'status_id' => Module::t('order_stage', 'Status ID'),
                'comment' => Module::t('order_stage', 'Comment'),
                'status.label'=>Module::t('order_stage', 'Status'),
                'createdUserLink'=>Module::t('order_stage', 'User'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return OrderStageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderStageQuery(get_called_class());
    }

    /**
     * Связка со статусом этапа заявки
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
}
