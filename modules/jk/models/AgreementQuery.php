<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Agreement]].
 *
 * @see Agreement
 */
class AgreementQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Agreement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Agreement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
