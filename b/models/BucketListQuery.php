<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BucketList]].
 *
 * @see BucketList
 */
class BucketListQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BucketList[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BucketList|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}