<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[RF]].
 *
 * @see Rf
 */
class RfQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Rf[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Rf|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
