<?php

namespace app\modules\admin\models;

/**
 * This is the ActiveQuery class for [[Retirement]].
 *
 * @see Retirement
 */
class RetirementQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Retirement[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Retirement|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
