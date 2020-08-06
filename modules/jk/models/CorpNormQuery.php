<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[CorpNorm]].
 *
 * @see CorpNorm
 */
class CorpNormQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return CorpNorm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CorpNorm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
