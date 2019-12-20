<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Zaim]].
 *
 * @see Zaim
 */
class ZaimQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Zaim[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Zaim|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
