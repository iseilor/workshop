<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[OrderStage]].
 *
 * @see OrderStage
 */
class OrderStageQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return OrderStage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return OrderStage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
