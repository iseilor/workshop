<?php

namespace app\modules\jk\models;

/**
 * This is the ActiveQuery class for [[Faq]].
 *
 * @see Faq
 */
class FaqQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    // Только опубликованные элементы
    public function published(){
        return $this->andWhere('deleted_at is null');
    }

    /**
     * {@inheritdoc}
     * @return Faq[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Faq|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
