<?php

namespace app\modules\jk\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Order]].
 *
 * @see Order
 */
class OrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function access()
    {
        $this->leftJoin('user', 'user.id = jk_order.created_by');
        return $this->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);
    }

    /**
     * {@inheritdoc}
     * @return Order[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Order|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
