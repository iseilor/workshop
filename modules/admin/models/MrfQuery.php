<?php

namespace app\modules\admin\models;

/**
 * This is the ActiveQuery class for [[Mrf]].
 *
 * @see Mrf
 */
class MrfQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Mrf[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mrf|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
