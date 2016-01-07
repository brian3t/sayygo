<?php

namespace backend\models\base;

use Yii;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "bucket_item".
 *
 * @property integer $id
 * @property string $name
 * @property integer $bucket_list_id
 * @property integer $order
 *
 * @property \backend\models\BucketList $bucketList
 */
class BucketItem extends \yii\db\ActiveRecord
{

    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bucket_item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'bucket_list_id' => 'Bucket List ID',
            'order' => 'Order',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBucketList()
    {
        return $this->hasOne(\backend\models\BucketList::className(), ['id' => 'bucket_list_id']);
    }

/**
     * @inheritdoc
     * @return type mixed
     */ 
    public function behaviors()
    {
        return [
            [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\BucketItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\BucketItemQuery(get_called_class());
    }
}
