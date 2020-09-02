<?php

namespace app\modules\jk\models;

use Yii;

/**
 * This is the ActiveQuery class for [[Zaim]].
 *
 * @see Zaim
 */
class ZaimQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    // Есть доступ к которым
    public function access()
    {
        $this->leftJoin('user', 'user.id = jk_zaim.created_by');
        return $this->andWhere('user.filial_id=' . Yii::$app->user->identity->filial_id);
    }

    /**
     * {@inheritdoc}
     * @return Zaim[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Zaim|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
