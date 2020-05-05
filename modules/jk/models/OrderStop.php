<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use app\modules\user\models\User;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "jk_stop".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property int      $order_id
 * @property int      $stop_id
 * @property string   $comment
 */
class OrderStop extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order_stop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stop_id', 'comment'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by', 'order_id', 'stop_id'], 'integer'],
            [['comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Module::t('order_stop', 'Created At'),
            'created_by' => Module::t('order_stop', 'Created By'),
            'createdUserLink'=> Module::t('order_stop', 'Created By'),
            'order_id' => Module::t('order_stop', 'Order'),
            'stop_id' => Module::t('order_stop', 'Stop'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return StopQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StopQuery(get_called_class());
    }

    // Связь с заявкой
    public function getOrder()
    {
        return $this->hasOne(Order::class, ['id' => 'order_id']);
    }
    public function getOrderLink()
    {
        $model = $this->hasOne(Order::class, ['id' => 'order_id'])->one();
        return Html::a($model->id, Url::to(['/jk/order/view' ,'id'=> $model->id],true));
    }
    // Связь с причиной отказа
    public function getStop()
    {
        return $this->hasOne(Stop::class, ['id' => 'stop_id']);
    }
    public function getStopLink()
    {
        $model = $this->hasOne(Stop::class, ['id' => 'stop_id'])->one();
        return Html::a($model->title, Url::to(['/jk/stop/view' ,'id'=> $model->id],true));
    }




}
