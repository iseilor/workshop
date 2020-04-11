<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Stop]].
 *
 * @see OrderStop
 */
class OrderStopQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderStop[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderStop|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
