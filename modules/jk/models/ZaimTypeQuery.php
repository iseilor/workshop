<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[ZaimType]].
 *
 * @see ZaimType
 */
class ZaimTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ZaimType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ZaimType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
