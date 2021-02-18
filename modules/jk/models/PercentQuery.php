<?php

namespace app\modules\jk\models;

use app\models\Query;
use Yii;

/**
 * This is the ActiveQuery class for [[Percent]].
 *
 * @see Percent
 */
class PercentQuery extends Query
{

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    // Есть доступ к которым
    public function access()
    {
        $this->leftJoin('user', 'user.id = jk_percent.created_by');
        return $this->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);
    }

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
