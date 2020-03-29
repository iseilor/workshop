<?php

namespace app\modules\pulsar\models;

/**
 * This is the ActiveQuery class for [[Pulsar]].
 *
 * @see Pulsar
 */
class PulsarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Pulsar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Pulsar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
