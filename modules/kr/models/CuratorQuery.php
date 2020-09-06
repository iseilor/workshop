<?php

namespace app\modules\kr\models;

/**
 * This is the ActiveQuery class for [[Curator]].
 *
 * @see Curator
 */
class CuratorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Curator[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Curator|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
