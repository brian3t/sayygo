<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[Brian3t]].
 *
 * @see Brian3t
 */
class Brian3tQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Brian3t[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Brian3t|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}