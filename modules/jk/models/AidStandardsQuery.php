<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[AidStandards]].
 *
 * @see CorpNorm
 */
class AidStandardsQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return AidStandards[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AidStandards|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
