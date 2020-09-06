<?php

namespace app\modules\kr\models;

/**
 * This is the ActiveQuery class for [[Block]].
 *
 * @see Block
 */
class BlockQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Block[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Block|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
