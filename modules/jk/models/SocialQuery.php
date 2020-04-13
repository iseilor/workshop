<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Social]].
 *
 * @see Social
 */
class SocialQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Social[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Social|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
