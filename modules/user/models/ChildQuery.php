<?php

namespace app\modules\user\models;
use app\models\Query;

/**
 * This is the ActiveQuery class for [[Child]].
 *
 * @see Child
 */
class ChildQuery extends Query
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Child[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Child|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
