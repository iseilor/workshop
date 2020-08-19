<?php

namespace app\modules\jk\models;







use app\models\Query;

/**
 * This is the ActiveQuery class for [[Doc]].
 *
 * @see Doc
 */
class DocQuery extends Query
{


    /**
     * {@inheritdoc}
     * @return Doc[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Doc|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
