<?php

namespace app\modules\jk\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Stop]].
 *
 * @see Stop
 */
class StopQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    public function access()
    {
        $this->leftJoin('user', 'user.id = jk_order_stop.created_by');
        return $this->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);
    }

    /**
     * {@inheritdoc}
     * @return Stop[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Stop|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
