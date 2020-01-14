<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Min]].
 *
 * @see Min
 */
class MinQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Min[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Min|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
