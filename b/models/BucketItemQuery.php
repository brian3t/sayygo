<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[BucketItem]].
 *
 * @see BucketItem
 */
class BucketItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return BucketItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return BucketItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}