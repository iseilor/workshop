<?php

namespace app\modules\user\models;

/**
 * This is the ActiveQuery class for [[UserChild]].
 *
 * @see UserChild
 */
class UserChildQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserChild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserChild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
