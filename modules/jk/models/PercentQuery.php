<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Percent]].
 *
 * @see Percent
 */
class PercentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Percent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Percent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
