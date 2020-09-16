<?php

namespace app\modules\kr\models;



use app\models\Query;

/**
 * This is the ActiveQuery class for [[Curator]].
 *
 * @see Curator
 */
class CuratorQuery extends Query
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
